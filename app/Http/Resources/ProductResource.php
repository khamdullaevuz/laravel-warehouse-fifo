<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_group_id' => $this->product_group_id,
            'name' => $this->name,
            'stock' => $this->stock,
            'price' => $this->price,
            'income_date' => $this->income_date,
        ];
    }
}
