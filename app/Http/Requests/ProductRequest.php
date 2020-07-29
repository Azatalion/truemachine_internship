<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'code' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'category_id' => 'required',
        ];

        if ($this->route()->named('products.store')) {
            $rules['code'] .= '|unique:products,code';
        }

        return $rules;
    }

    public function messages() 
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'min' => 'Поле :attribute должно содержать минимум :min символа.',
            'description.min' => 'Поле :attribute должно содержать минимум :min символов.',
            'max' => 'Поле :attribute должно содержать максимум :max символа(ов).',
            'unique' => 'Код :input уже используется.',
        ];
    }
}
