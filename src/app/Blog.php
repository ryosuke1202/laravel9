<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    // idとタイムスタンプ以外を指定
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'product_id',
    ];
    /**
     * @var mixed
     */
    private $user_id;

    /**
     * テーブルリレーションを定義
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
