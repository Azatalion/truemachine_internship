<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'text' => 'required',
            'mark' => 'required|numeric|min:1|max:5',
        ];
    }

    public function messages() 
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'min' => 'Поле :attribute должно быть не меньше :min.',
            'max' => 'Поле :attribute должно быть не больше :max.',
        ];
    }
}
