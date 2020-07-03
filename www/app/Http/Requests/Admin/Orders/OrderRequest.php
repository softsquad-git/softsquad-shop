<?php

namespace App\Http\Requests\Admin\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'total_price' => 'required',
            'post_code' => 'required',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'additional_information' => 'nullable|string|max:1000',
            'name' => 'required'
        ];
    }
}
