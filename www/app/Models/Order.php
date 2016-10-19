<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the customer that owns the order. (n:1)
     */
    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Get the address that belongs to the order. (1:1)
     */
    public function addresses()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the status that belongs to the order. (1:1)
     */
    public function order_statuses()
    {
        return $this->belongsTo(Order_status::class);
    }

    /**
     * Get the products for the order. (1:n)
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    /**
     * Query that returns all order data
     *
     * @param $query
     */
    public function scopeAllOrderData($query){
        $query->join('order_statuses' , 'orders.order_status_id','=','order_statuses.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('users', 'customers.user_id', '=', 'users.id')
                ->join('addresses', 'orders.address_id', '=', 'addresses.id')
                ->join('cities', 'addresses.city_id', '=', 'cities.id')
                ->join('countries', 'cities.country_id' , '=', 'countries.id')
                ->select('orders.id','order_statuses.name AS status', 'order_statuses.description', 'orders.created_at', 'orders.updated_at',
                        'customers.first_name', 'customers.last_name', 'addresses.street', 'cities.name AS city', 'countries.name AS country',
                        'users.email', 'users.username');
    }

    /**
     * Query that returns all products data for given order (id).
     *
     * @param $query
     * @param $id
     */
    public function scopeOrderProducts($query, $id){
        $query->join('order_product','order_product.order_id', '=','orders.id')
                ->join('products', 'order_product.product_id','=','products.id')
                ->join('manufacturers', 'products.manufacturer_id', '=', 'manufacturers.id')
                ->select('order_product.quantity','orders.id', 'orders.created_at', 'orders.updated_at', 'orders.deleted_at',
                        'products.id AS product_id', 'products.name AS product', 'products.price AS price', 'products.preview_url AS image_url',
                        'manufacturers.name AS manufacturer')
                //->selectRaw('sum(price) AS totaalprijs')
                ->where('orders.id','=',$id);
    }

    /**
     * Query that returns detailed data for given order (id).
     *
     * @param $query
     * @param $id
     */
    public function scopeOrderDetails($query, $id){
        $query->join('customers', 'orders.customer_id', '=','customers.id')
                ->join('addresses', 'orders.address_id', '=', 'addresses.id')
                ->join('cities', 'addresses.city_id', '=', 'cities.id')
                ->join('countries', 'cities.country_id' , '=', 'countries.id')
                ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
                ->select('orders.id AS order_id', 'order_statuses.name AS status', 'order_statuses.id AS status_id','order_statuses.description AS status_desc',
                        'orders.created_at', 'orders.updated_at', 'orders.deleted_at',
                        'customers.first_name', 'customers.last_name',
                        'addresses.street', 'cities.name AS city', 'countries.name AS country')
                ->where('orders.id', '=', $id);
    }

    /**
     * Query that returns total order price for given order (id).
     * 
     * @param $query
     * @param $id
     */
    public function scopeTotalPrice($query, $id){
        $query->join('order_product','order_product.order_id','=','orders.id')
                ->join('products','order_product.product_id','=','products.id')
                ->join('taxes','products.tax_id','=','taxes.id')
                ->join('customers','orders.customer_id','=','customers.id')
                ->orderby('orders.id')
                ->selectRaw('SUM(order_product.quantity * products.price) AS total_price')
                ->groupby('orders.id')
                ->where('orders.id','=',$id)
            ;
    }

    public function scopeCountStatus($query, $status){
        $query->selectRaw('count(orders.id) AS n')
                ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
                ->where('order_statuses.name' , '=', $status);
    }

    protected $fillable = [
        'order_status_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
