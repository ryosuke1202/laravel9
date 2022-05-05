<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required|max:30',
            'price' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer',
            'tag_id' => 'required|integer',
            'type_id' => 'required|integer',
            'image' => 'image|max:1024',
        ];
    }

    //バリデーションメッセージ
    public function attributes()
    {
        return [
            'name' => '商品名',
            'price' => '値段',
            'description' => '商品説明',
            'stock' => '在庫数',
            'tag_id' => '製品タグ',
            'type_id' => '製品タイプ',
            'image' => '画像',
        ];
    }
}
