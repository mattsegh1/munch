<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the country that owns the city. (n:1)
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the addresses for the city. (1:n)
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Query to get all all non deleted cities' data.
     *
     * @param $query
     */
    public function scopeAllCitiesData($query){
        $query->join('countries', 'cities.country_id', '=', 'countries.id')
            ->select('cities.*', 'countries.name AS country_name')
            ->where('cities.deleted_at','=', null);
    }

    protected $fillable = [
        'country_id',
        'name',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    
    
}
