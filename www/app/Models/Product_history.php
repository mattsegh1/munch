<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product_history extends Model
{
    /**
     * Get the product for the product history entry. (1:1)
     */
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param $query
     * @param $id
     */
    public function scopeProductHistory($query, $id){
        $query->select('quantity','price','quantity', 'created_at')
                ->where('product_id','=',$id)
                ->orderby('created_at');
    }

    protected $fillable = [
        'product_id',
        'price',
        'quantity'
    ];
}
