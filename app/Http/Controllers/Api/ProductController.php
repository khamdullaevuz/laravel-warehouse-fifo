<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'product_group_id' => 'required|exists:products,product_group_id',
        ]);

        $product_group_id = $data['product_group_id'];

        $products = Product::query()
            ->where('product_group_id', $product_group_id)
            ->orderBy('income_date')
            ->get();

        return new ProductCollection($products);
    }

    public function sell(SellRequest $request)
    {
        $data = $request->validated();
        $quantity = $data['quantity'];
        $product_group_id = $data['product_group_id'];

        $products = Product::query()
            ->where('product_group_id', $product_group_id)
            ->orderBy('income_date')
            ->get();

        foreach($products as $product)
        {
            if($product->stock > $quantity)
            {
                $product->stock -= $quantity;
                $product->save();
                break;
            }else{
                $quantity -= $product->stock;
                $product->stock = 0;
                $product->save();
            }

        }

        return new ProductCollection($products);
    }
}
