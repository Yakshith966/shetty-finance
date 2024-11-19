<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductServiceDetailRequest extends FormRequest
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
            // 'service_id' => 'required|string|unique:product_service_details,service_id',  //It is generated automatically in model, needed to remove from request validation 
            'customer_id' => 'required|exists:customer_details,id',
            'product_type' => 'required|string',
            'product_name' => 'required|string',
            'serial_number' => 'nullable|string',
            'model_number' => 'nullable|string',
            'description' => 'nullable|string',
            'other_collected_item' => 'nullable|string',
            'product_recieved_date' => 'required|date',
            'service_status' => 'required|exists:service_statuses,id',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'The service ID is required.',
            'service_id.unique' => 'The service ID must be unique.',
            'customer_id.required' => 'The customer ID is required.',
            'customer_id.exists' => 'The selected customer ID is invalid.',
            'product_type.required' => 'The product type is required.',
            'product_name.required' => 'The product name is required.',
            'product_recieved_date.required' => 'The product received date is required.',
            'product_recieved_date.date' => 'The product received date must be a valid date.',
            'service_status.required' => 'The service status is required.',
            'service_status.exists' => 'The selected service status is invalid.',
        ];
    }
}
