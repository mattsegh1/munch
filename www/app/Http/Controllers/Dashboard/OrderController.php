<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order_status;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use DB;

class OrderController extends Controller
{
    // Index (shows all items)
    public function index(Request $request)
    {
        //fetches the data from the querystring.
        $sort = $request->input('sort');
        $filter = $request->input('filter');
        $search = $request->input('search');

        $orders = Order::allOrderData();
        $statuses = Order_status::all();

        if ($search) {
            $orders->Where(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name)"), 'LIKE', "%" . $search . "%");
        }

        if ($sort && $filter) {
            $orders = $orders
                ->orderby($sort)
                ->where('order_statuses.name', '=', $filter)
                ->get();
        } else if ($sort) {
            $orders = $orders->orderby($sort)->get();
        } else if ($filter) {
            $orders = $orders->where('order_statuses.name', '=', $filter)->get();
        } else {
            //default sorting if no other filtering/sorting is given.
            $orders = $orders->get();
        }

        return view('dashboard.orders.overview', compact('orders', 'statuses'));
    }

    // Show details form (of given id item)
    public function show($id)
    {
        $order_details = Order::orderDetails($id)->get();
        $order_products = Order::orderProducts($id)->get();
        $saldo = Order::totalPrice($id)->first();

        return view('dashboard.orders.order', compact('order_details', 'order_products', 'saldo'));
    }

    // Show editing form
    public function edit($id)
    {
        $order = Order::orderDetails($id)->get();
        $orderProducts = Order::orderProducts($id)->get();

        $list_statuses = Order_status::pluck('name', 'id');

        return view('dashboard.orders.edit', compact('order', 'orderProducts', 'list_statuses'));
    }

    // Persists new data to given id item to the DB
    public function update(Request $request, $id)
    {
        $rules = [
            'status_id' => 'required|int',
        ];

        $this->validate($request, $rules);

        Order::FindOrFail($id)
            ->update(['order_status_id' => $request->get('status_id'),
            ]);

        return redirect('order')->with([
            'flash_message' => 'Order bijgewerkt.',
            'flash_message_important' => false
        ]);
    }
}
