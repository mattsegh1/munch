<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the cities for the country. (1:n)
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    protected $fillable = [
        'name',
        'logo_url',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
