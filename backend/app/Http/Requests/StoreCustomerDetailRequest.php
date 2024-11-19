<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerDetailRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer_details,email',
            'phone_number' => 'required|digits_between:10,15|unique:customer_details,phone_number',
            'alternate_phone_number' => 'nullable|digits_between:10,15|unique:customer_details,alternate_phone_number',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already in use.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.digits_between' => 'The phone number must be between 10 and 15 digits.',
            'phone_number.unique' => 'This phone number is already in use.',
            'alternate_phone_number.digits_between' => 'The alternate phone number must be between 10 and 15 digits.',
            'alternate_phone_number.unique' => 'This alternate phone number is already in use.',
        ];
    }
}
