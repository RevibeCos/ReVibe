<?php

namespace App\Http\Requests\Website\Address;

use Illuminate\Foundation\Http\FormRequest;

class AddressCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'city' => 'required|integer',
            'state' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => __('validation.user_id_required'),
            'user_id.exists' => __('validation.user_id_exists'),
            'name.required' => __('validation.name_required'),
            'name.string' => __('validation.name_string'),
            'name.max' => __('validation.name_max'),
            'city.required' => __('validation.city_required'),
            'city.integer' => __('validation.city_integer'),
            'state.required' => __('validation.state_required'),
            'state.string' => __('validation.state_string'),
            'state.max' => __('validation.state_max'),
            'phone_number.required' => __('validation.phone_number_required'),
            'phone_number.string' => __('validation.phone_number_string'),
            'phone_number.max' => __('validation.phone_number_max'),
        ];
    }
}
