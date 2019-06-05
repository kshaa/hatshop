<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The owner of this product.
     */
    public function owner()
    {
        return $this->hasOne(UserProduct::class, 'users');
    }

    /**
     * The creator of this product.
     */
    public function creator()
    {
        return $this->hasOne(UserProduct::class, 'users');
    }
}
