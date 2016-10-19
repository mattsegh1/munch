<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the manufacturer that owns the product. (n:1)
     */
    public function manufacturers()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * Get the category that belongs to the product. (n:1)
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the ratings for the product.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * The orders that belong to the product. (n:n)
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * The carts that belong to the product. (n:n)
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    /**
     * Get the tax that applies to the product. (n:1)
     */
    public function taxes()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * Get the discount that belongs to the product.
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * Query to get all the ratings from given product (id).
     *
     * @param $query
     * @param $id
     */
    public function scopeAllRatings($query, $id){
        $query->join('ratings','ratings.product_id','=','products.id')
                ->where('products.id', '=',$id)
                ->selectraw('SUM(ratings.value) AS totalValue')
                ->selectraw('count(ratings.id) AS n')
                ->selectraw('AVG(ratings.value) AS avgValue');
    }

    /**
     * Gets the most popular product (most sold units).
     *
     * @param $query
     */
    public function scopeMostPopular($query){
        $query
            ->select('products.id', 'products.name')
            ->selectraw('SUM(order_product.quantity) AS nSold')
            ->join('order_product','products.id','=','order_product.product_id')
            ->groupby('products.id')
            ->orderby('nSold', 'DESC')
            ->where('order_product.quantity','!=','0')
            ->limit(10);
    }

    /**
     * Gets the most rated product.
     *
     * @param $query
     */
    public function scopeMostRated($query){
        $query
            ->select('products.id','products.name')
            //->selectraw('ROUND(SUM(ratings.value)/COUNT(ratings.value),2) AS avg_rating')
            ->selectraw('ROUND(ROUND(SUM(ratings.value)/COUNT(ratings.value) / .5,0)) * .5 AS avg_rating')
            ->selectraw('COUNT(ratings.id) AS nRatings')
            ->join('ratings','ratings.product_id','=','products.id')
            ->groupby('products.id')
            ->orderby('avg_rating', "DESC")
            ->limit(10);
    }

    /**
     * Get the total revenue from the shop.
     *
     * @param $query
     */
    public function scopeRevenue($query){
        $query->select(DB::raw('SUM(order_product.quantity * products.price) AS amount'))
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders','order_product.order_id','=','orders.id')
            ->join('order_statuses','orders.order_status_id','=','order_statuses.id')
            ->where('order_statuses.name','=','DELIVERED')
            ->withTrashed();
    }

    public function scopeCount($query){
        $query->selectRaw('COUNT(id) AS n');
    }

    protected $fillable = [
        'name',
        'manufacturer_id',
        'category_id',
        'discount_id',
        'price',
        'calories',
        'preview_url',
        'tax_id',
        'description',
        'quantity',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];






}
