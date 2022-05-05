<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductTag extends Model
{
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'products');
    }

    public function tags(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tags');
    }
}
