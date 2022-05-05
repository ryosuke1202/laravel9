<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Favorite extends Model
{
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users');
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'products');
    }
}
