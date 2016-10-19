<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    /**
     * Get the orders for the order status. (n:1)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
