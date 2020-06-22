<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'alias' => 'required|string|unique:categories'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.errors.required'),
            'name.string' => trans('validation.errors.string'),
            'name.min' => trans('validation.errors.min'),
            'alias.required' => trans('validation.errors.required'),
            'alias.string' => trans('validation.errors.string'),
            'alias.unique' => trans('validation.errors.unique')
        ];
    }
}
