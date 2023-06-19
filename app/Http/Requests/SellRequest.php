<?php

namespace App\Http\Requests;

use App\Rules\SellMaxRule;
use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_group_id' => 'required|exists:products,product_group_id',
            'quantity' => [
                'required',
                'integer',
                new SellMaxRule($this->product_group_id)
            ]
        ];
    }
}
