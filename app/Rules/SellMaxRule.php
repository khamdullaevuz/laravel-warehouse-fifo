<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SellMaxRule implements ValidationRule
{
    public function __construct(private $product_group_id)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $productMax = Product::where('product_group_id', $this->product_group_id)->sum('stock');
        if($value > $productMax)
        {
            $fail("The $attribute must be less than or equal to $productMax.");
        }
    }
}
