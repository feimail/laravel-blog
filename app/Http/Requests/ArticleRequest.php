<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|between:2,15',
            'content' =>  'required',
            'phrase'  => 'required'
        ];
    }

    public function messages()
    {
        return [

          'title.between' => '文章标题必须介于 2 - 15 个字符之间。',
          'title.required' => '文章标题不能为空。',
          'content.required'  => '文章内容不能为空',
          'phrase'  => '文章简介不能为空',
        ];
    }


}
