<?php

namespace App\Http\Requests;

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
          'name' => 'required|between:2,8|unique:categories',
        ];
    }


    public function messages()
    {
        return [
          'name.unique' => '分类已被占用，请重新填写',
          'name.between' => '分类必须介于 2 - 8 个字符之间。',
          'name.required' => '分类不能为空。',
        ];
    }


}
