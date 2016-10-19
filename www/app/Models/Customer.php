<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;

class Customer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the customer. (1:1)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders for the customer. (1:n)
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Get the addresses for the customer (1:n).
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the ratings for the customer.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /* Accessors and mutators */
    //Naming convention = setAttributeNameAttribute

    /* Query Scopes */
    //Naming convention = scopeName

    /**
     * Query to return the best customer (most total revenue).
     *
     * @param $query
     */
    public function scopeBestCustomer($query){
        $query->select('customers.id','customers.first_name','customers.last_name',
                        'users.username',
                        'orders.id AS ORDER_ID',
                        'order_statuses.name AS STATUS',
                        'order_product.product_id', 'order_product.quantity AS nBought',
                        'products.name', 'products.price',
                        DB::raw('SUM(products.price * order_product.quantity) AS Total_Price'))
            ->join('users', 'customers.user_id','=','users.id')
            ->join('orders','orders.customer_id','=','customers.id')
            ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
            ->join('order_product','order_product.order_id','=','orders.id')
            ->join('products','order_product.product_id','=','products.id')
            ->where('order_statuses.name','=','DELIVERED')
            ->groupby('customers.id')
            ->orderby('Total_Price', 'DESC');
    }

    /**
     * Query to return all active customers data
     */
    public function scopeActive($query){
        $query->join('users', 'customers.user_id', '=','users.id')
              ->select('customers.*', 'users.id AS user_id', 'users.username AS username');
    }

    /**
     * Query to return all inactive (deleted) customers data
     */
    public function scopeInactive($query){
        $query->withTrashed()->whereNotNull('customers.deleted_at')
              ->join('users', 'customers.user_id', '=','users.id')
              ->select('customers.*', 'users.id AS user_id', 'users.username AS username');
    }

    /**
     * Query to return all active AND inactive (deleted) customers data
     */
    public function scopeAll($query){
        $query->withTrashed()
            ->join('users', 'customers.user_id', '=','users.id')
            ->select('customers.*', 'users.id AS user_id', 'users.username AS username');
    }

    /**
     * Query to return user data for given customer (customerId)
     *
     * @param $query
     * @param $customerId
     */
    public function scopeUserData($query, $customerId){
        $query->where('customers.id','=', $customerId)
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->join('addresses', 'addresses.customer_id', '=', 'customers.id')
            ->join('cities', 'addresses.city_id', '=', 'cities.id')
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->select('customers.id AS customer_id', 'first_name' , 'last_name',
                    'users.username', 'users.email', 'users.avatar_url', 'users.created_at',
                    'addresses.street',
                    'cities.name AS city',
                    'countries.name AS country');
    }

    public function scopeCount($query){
        $query->select(DB::raw('COUNT(id) AS n'));
    }

    public function scopeCountRatings($query, $customerId)
    {
        $query->selectraw('COUNT(ratings.id) AS n')
                ->join('ratings','ratings.customer_id','=','customers.id')
                ->where('customers.id','=',$customerId);
    }

    public function scopeCountOrders($query, $customerId)
    {
        $query->selectraw('COUNT(orders.id) AS n')
            ->join('orders','orders.customer_id','=','customers.id')
            ->where('customers.id','=',$customerId);
    }

    public function scopeSumRevenue($query, $customerId)
    {
        $query
            ->selectRaw('SUM((order_product.quantity * products.price)) AS TOTAL')
            ->join('orders','orders.customer_id','=','customers.id')
            ->join('order_product','order_product.order_id','=','orders.id')
            ->join('products','order_product.product_id','=','products.id')
            ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
            ->where('customers.id','=',$customerId)
            ->where('order_statuses.name','=','DELIVERED');
    }

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
