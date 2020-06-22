<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8|string',
            'nick' => 'nullable|min:4|unique:specific_data_user|max:20',
            'location' => 'nullable|string|min:3',
            'sex' => 'nullable|integer',
            'contact_phone' => 'nullable|string|min:9'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('validation.errors.required'),
            'name.string' => trans('validation.errors.string'),
            'name.min' => trans('validation.errors.min'),
            'last_name.required' => trans('validation.errors.required'),
            'last_name.string' => trans('validation.errors.string'),
            'last_name.min' => trans('validation.errors.min'),
            'email.required' => trans('validation.errors.required'),
            'email.email' => trans('validation.errors.email'),
            'password.required' => trans('validation.errors.required'),
            'password.string' => trans('validation.errors.string'),
            'password.min' => trans('validation.errors.min'),
            'nick.nullable' => trans('validation.errors.null'),
            'nick.min' => trans('validation.errors.min'),
            'nick.unique' => trans('validation.errors.unique'),
            'nick.max' => trans('validation.errors.max'),
            'location.nullable' => trans('validation.errors.null'),
            'location.string' => trans('validation.errors.string'),
            'location.min' => trans('validation.errors.min'),
            'sex.nullable' => trans('validation.errors.null'),
            'sex.integer' => trans('validation.errors.integer'),
            'contact_phone.nullable' => trans('validation.errors.null'),
            'contact_phone.string' => trans('validation.errors.string'),
            'contact_phone.min' => trans('validation.errors.min')
        ];
    }
}
