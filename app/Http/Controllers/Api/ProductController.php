<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::get(['id', 'name']));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load(['batches' => function($query){
            $query->orderBy('income_date', 'asc');
        }]));
    }

    public function sell(SellRequest $request)
    {
        $data = $request->validated();
        $products = $data['products'];

        foreach($products as $product)
        {
            $_product = Product::with(['batches' => function($query){
                $query->orderBy('income_date', 'asc');
            }])->find($product['id']);
            $quantity = $product['quantity'];
            $batches = $_product->batches;
            $max = $batches->sum('stock');
            if($quantity > $max)
            {
                return response()->json([
                    'message' => 'Not enough stock for product ' . $_product['name']
                ], 400);
            }
            foreach($batches as $batch)
            {
                if($batch->stock > $quantity)
                {
                    $batch->stock -= $quantity;
                    $batch->save();
                    break;
                }else{
                    $quantity -= $batch->stock;
                    $batch->stock = 0;
                    $batch->save();
                }
            }
        }

        return response()->json([
            'message' => 'Products sold successfully'
        ]);
    }
}
