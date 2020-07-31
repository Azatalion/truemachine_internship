<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Category;

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
        $minCategoryId = Category::min('id');
        $maxCategoryId = Category::max('id');

        $rules = [
            'code' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'category_id' => 'required|numeric|min:'.$minCategoryId.'|max:'.$maxCategoryId,
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
            'category_id.min' => 'Поле :attribute не может быть меньше :min.',
            'max' => 'Поле :attribute должно содержать максимум :max символа(ов).',
            'category_id.max' => 'Поле :attribute не может быть больше :max.',
            'unique' => 'Код :input уже используется.',
        ];
    }
}
