<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Get the orders for the address. (1:n)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the city that belongs to the address. (n:1)
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the customer that belongs to the address. (n:1)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Query that returns all data for non-deleted addresses.
     *
     * @param $query
     */
    public function scopeAllAddresses($query){
        $query->join('cities', 'addresses.city_id', '=', 'cities.id')
                ->join('countries', 'cities.country_id', '=', 'countries.id')
                ->select('addresses.*', 'cities.name AS city_name', 'countries.name AS country_name', 'countries.id AS country_id')
                ->where('addresses.deleted_at','=', null);
    }

    /**
     * Query that returns all data for specified address (id).
     *
     * @param $query
     * @param $id
     */
    public function scopeGetAddress($query, $id){
        $query->join('cities', 'addresses.city_id', '=', 'cities.id')
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->select('addresses.*', 'cities.name AS city_name', 'countries.name AS country_name', 'countries.id AS country_id')
            ->where('addresses.deleted_at','=', null)
            ->where('addresses.id', '=', $id);
    }

    protected $fillable = [
        'street',
        'city_id',
        'customer_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

}
