<?php

namespace App\Http\Requests\Website\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'cart_id.required' => __('validation.cart_id_required'),
            'cart_id.exists' => __('validation.cart_id_exists'),
            'product_id.required' => __('validation.product_id_required'),
            'product_id.exists' => __('validation.product_id_exists'),
            'quantity.required' => __('validation.quantity_required'),
            'quantity.integer' => __('validation.quantity_integer'),
            'quantity.min' => __('validation.quantity_min'),
            'price.required' => __('validation.price_required'),
            'price.numeric' => __('validation.price_numeric'),
            'price.min' => __('validation.price_min'),
        ];
    }
}
