<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Discount;


class DiscountController extends Controller
{

    // Shows resource form for creating a new resource
    public function create(Request $request)
    {
        return view('dashboard.discounts.add');
    }

    // Creates new resource and persists it to the DB
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products|min:2|max:255',
            'percentage' => 'required|numeric|min:1|max:100',
            'discount_start' => 'required|date_format:Y-m-d',
            'discount_end' => 'required|date_format:Y-m-d',
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        Discount::create($input);

        return redirect($request->session()->get('redirect_url')|'/');
    }


}
