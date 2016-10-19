<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    /**
     * Get the products for the tax. (1:n)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
