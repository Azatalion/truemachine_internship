<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
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
        
        Validator::extend('numeric_array', function($attribute, $value, $parameters)
        {
            foreach($value as $v) {
                if(!(int)($v)) 
                    return false;                
            }
            return true;
        });

        Validator::extend('min_array', function($attribute, $value, $parameters)
        {
            foreach($value as $v) {
                if($v < Category::min('id')) 
                    return false;                
            }
            return true;
        });

        Validator::extend('max_array', function($attribute, $value, $parameters)
        {
            foreach($value as $v) {
                if($v > Category::max('id')) 
                    return false;                
            }
            return true;
        });

        $rules = [
            'code' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'category_id' => 'required|numeric_array|min_array|max_array',
        ];

        if ($this->route()->named('products.store') || $this->route()->named('api.products.store')) {
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
            'numeric_array' => 'Поле :attribute может содержать только числовые значения.',
            'min_array' => 'Поле :attribute не может содержать значения меньше '.Category::min('id').'.',
            'max_array' => 'Поле :attribute не может содержать значения больше '.Category::max('id').'.',
        ];
    }
}
