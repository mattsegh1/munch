<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * Get the status that belongs to the cart. (1:1)
     */
    public function cart_statuses()
    {
        return $this->belongsTo(Cart_status::class);
    }

    /**
     * The products that belong to the cart. (n:n)
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
