<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:150', // product name is required and should not exceed 255 characters
            'description' => 'nullable|string|max:1000', // description is optional, with max 1000 characters 
            'price' => 'required|numeric|min:1', // price should be numeric and non-negative
            'available_units' => 'required|numeric|min:1', // price should be numeric and non-negative
            'product_code' => [ 
                    'required', 
                    'string',
                    'max:50',
                    Rule::unique('product', 'product_code')->ignore($this->product, 'id')
                ],
        ];
    }
}
