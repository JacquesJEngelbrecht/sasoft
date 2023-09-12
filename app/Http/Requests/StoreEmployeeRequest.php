<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'contact_phone' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required|date|before:2005-01-01',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'postal_code' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'skills' => 'required|array|min:1',
            'skills.*' => 'string|max:255|distinct',
            'years_experience' => 'required|integer|min:0|max:50',
            'level' => 'required|integer|min:0|max:50'
        ];
    }
}
