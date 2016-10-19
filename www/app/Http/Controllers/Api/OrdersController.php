<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Customer;

use Illuminate\Http\Response;

class OrdersController extends Controller
{
    // Index (shows all items)
    public function index($customer_id)
    {

        $orders = Order::join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
            ->select('*',
                'products.id AS products_id',
                'products.name AS products_name',
                'products.quantity AS products_quantity',
                'order_statuses.id AS status_id',
                'order_statuses.name AS status',
                'orders.created_at AS order_placed_date',
                'order_product.quantity AS order_product_quantity'
                )
            ->where('customer_id','=',$customer_id)
            ->get();

        return $orders;


        
    }

    // Show details form (of given id item)
    public function show($id)
    {
        $order_details = Order::orderDetails($id)->get();
        $order_products = Order::orderProducts($id)->get();
        $saldo = Order::totalPrice($id)->first();

        return $order_products ?: response()
            ->json([
                'error' => "Order `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);


    }
}
