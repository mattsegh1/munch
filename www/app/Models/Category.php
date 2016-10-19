<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the products for the category. (1:n)
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
