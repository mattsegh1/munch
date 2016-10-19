<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index(Request $request)
    {

        //fetches the data from the querystring.
        $sort = $request->input('sort');

        $ratings = Rating::select('ratings.value', 'users.username', 'products.name', 'ratings.created_at',
            'products.id AS product_id', 'ratings.id AS rating_id', 'customers.id AS customer_id', 'users.id AS user_id')
            ->join('customers', 'ratings.customer_id', '=', 'customers.id')
            ->join('products', 'ratings.product_id', '=', 'products.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->whereNull('products.deleted_at');

        if ($sort) {
            $ratings = $ratings->orderby($sort)->get();
        } else {
            //default sorting if no other filtering/sorting is given.
            $ratings = $ratings->orderby('ratings.id')->get();
        }

        return view('dashboard.ratings.overview', compact('ratings'));
    }
}
