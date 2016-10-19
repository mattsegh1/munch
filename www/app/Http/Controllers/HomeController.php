<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Order;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generalData['customers'] = Customer::count()->first();
        $generalData['ratings'] = Rating::count()->first();
        $generalData['revenues'] = Product::revenue()->first();
        $generalData['orders'] = Order::countStatus('DELIVERED')->first();
        $generalData['users'] = User::count()->first();

        $bestProducts = Product::mostPopular()->get();
        $bestCustomers = Customer::BestCustomer()->get();
        $mostRated = Product::mostRated()->get();

        return view('dashboard.home', compact('bestProducts','bestCustomers', 'generalData', 'mostRated'));

    }
}
