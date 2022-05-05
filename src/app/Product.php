<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'tag_id',
        'stock',
        'type_id',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function csvHeader() {
        return [
                'id',
                '商品名',
                '価格',
                '商品説明',
                '在庫数',
                '商品タイプ',
                '登録日',
        ];
    }

    public function getProductArray() {
        $productsCollection = $this->with('type')->get();
        //リレーション先の商品タイプ名をtype_idに代入
        foreach ($productsCollection as $product) {
            $product->type_id = $product->type->name;
        }
        //CSV出力するためコレクションを配列に変換
        $productsArray = $productsCollection->toArray();
        return $productsArray;
    }

    public function csvProduct($row){
        return [
            $row['id'],
            $row['name'],
            $row['price'],
            $row['description'],
            $row['stock'],
            $row['type_id'],
            $row['created_at'],
        ];
    }
}
