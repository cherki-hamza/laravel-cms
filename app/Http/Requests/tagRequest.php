<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tagRequest extends FormRequest
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
            'name' => 'required|unique:tags|min:3'
        ];
    }

    // ouveride the validation messages
    public function messages()
    {
        return [
            'name.required' => 'ههه الله يهديك راه ضاروري وماكد ياراس الطارو . الله يشافيكك',
            'name.unique'   => 'امين اخي بدل الفئة الله يشفيك ^_^'
        ];
    }
}
