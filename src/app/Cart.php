<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function types(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function statuses(): BelongsTo
    {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function totalFee(): HasOne
    {
        return $this->hasOne('App\TotalFee', 'id');
    }

    public function tags(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'id');
    }
}
