<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Category;

class ProductRequest extends FormRequest
{

    public $min = null;
    public $max = null;

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
        $this->min = Category::min('id');
        $this->max = Category::max('id');
        
        Validator::extend('check_category_id', function($attribute, $value, $parameters)
        {
            if (!(int)$value) {
                return false;
            }
            else if ($value < $this->min) {
                return false;
            }
            else if ($value > $this->max) {
                return false;
            }
            return true;
        });

        $rules = [
            'code' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'category_id' => 'required',
            'category_id.*' => 'check_category_id',
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
            'check_category_id' => 'Поле category_id должно быть<br>числом не меньше '.$this->min.' и не больше '.$this->max.'.',
        ];
    }
}
