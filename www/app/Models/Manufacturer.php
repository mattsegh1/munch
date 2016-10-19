<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The products that belong to the manufacturer. (1:n)
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeAllProducts($query, $id)
    {
        $query->select('*')
            ->join('products','products.manufacturer_id','=','manufacturers.id')
            ->where('manufacturers.id','=',$id);
    }

    protected $fillable = [
        'name',
        'logo_url',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
