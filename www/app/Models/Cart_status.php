<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_status extends Model
{
    // Relationships
    // =============

    /**
     * Get the cart for the cart_status (1:n).
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
