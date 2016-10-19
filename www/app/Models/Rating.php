<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Rating extends Model
{
    /**
     * Get the product that owns the rating. (n:1)
     */
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the customer that owns the rating. (n:1)
     */
    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeCount($query){
        $query->select(DB::raw('COUNT(ratings.id) AS n'))
                ->join('products','ratings.product_id','=','products.id')
                ->whereNull('deleted_at');
    }

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

}
