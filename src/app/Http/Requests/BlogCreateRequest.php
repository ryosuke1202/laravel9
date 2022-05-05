<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ];
    }

    //バリデーションメッセージ
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'product_id' => '商品',
        ];
    }
}
