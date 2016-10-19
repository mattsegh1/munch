<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{

    /**
     * Get the products with the discount. (1:n)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'name',
        'percentage',
        'discount_start',
        'discount_end'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
