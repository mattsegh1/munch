<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Address;
use App\Models\Customer;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\User;

class CustomerController extends Controller
{
    // Index (shows all items, default sorted by FN)
    public function index(Request $request)
    {

        //fetches the data from the querystring.
        $sort = $request->input('sort');
        $search = $request->input('search');

        $customers = Customer::active();

        if($search)
        {
            $customers->Where(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name)"), 'LIKE', "%".$search."%");
        }

        if($sort){
            $customers->orderby($sort); //inactive and all available!
        }
        else{
            //default sorting if no other filtering/sorting is given.
            $customers->orderby('first_name');
        }
        $customers = $customers->get();



        return view('dashboard.customers.overview', compact('customers'));
    }

    // Shows resource form for creating a new resource
    public function create()
    {
        $cities_list = City::pluck('name', 'id');

        return view('dashboard.customers.add', compact('cities_list'));
    }

    // Creates new resource and persists it to the DB
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'username' => 'required|unique:users|min:4|max:32',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
        ];

        $this->validate($request, $rules);

        $userData = [
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];
        $customerData = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
        ];



        $user = new User($userData);
        $customer = new Customer($customerData);
        $address = new Address($request->only('street', 'city_id'));
        $user->save();

        $customer->user()->associate($user);
        $customer->save();

        $address->customer()->associate($customer);

        //return $address->toArray();
        $address->save();

        return redirect('customer')->with([
            'flash_message' => 'Klant werd toegevoegd.',
            'flash_message_important' => false
        ]);
    }

    // Show details form (of given id item)
    public function show($id)
    {
        $customer =  Customer::userData($id)->first();
        $customer->ratings = Customer::countRatings($id)->first();
        $customer->orders = Customer::countOrders($id)->first();
        $customer->revenue = Customer::sumRevenue($id)->first();

        return view('dashboard.customers.customer', compact('customer'));
    }

    // Show editing form
    public function edit($id)
    {
        $customer =  Customer::userData($id)->first();
        $cities = City::pluck('name','id');

        return view('dashboard.customers.edit', compact('customer', 'cities'));
    }

    // Persists new data to given id item to the DB
    public function update(Request $request, $id)
    {
        $rules = [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'username' => 'required|min:4|max:32',
            'email' => 'required',
            'password' => 'string|min:6|same:password_confirmation',
            'password_confirmation' => 'string|min:6|same:password',
        ];

        $this->validate($request, $rules);

        $customer = Customer::find($id);
        $user = User::find($customer->user_id);
        $address = Address::where('customer_id','=',$id)->first();

        $customer->first_name = $request->get('first_name');
        $customer->last_name = $request->get('last_name');

        $user->email = $request->get('email');


        if($request->get('password') && $request->get('password_confirmation'))
        {
            $user->password = bcrypt($request->get('password'));
        }


        $address->street = $request->get('street');
        $address->city_id = $request->get('city_id');

        $user->save();
        $address->save();
        $customer->save();

        return redirect('customer')->with([
            'flash_message' => 'Klant werd bijgewerkt.',
            'flash_message_important' => false
        ]);
    }

    // Soft deletes item with given id in DB.
    public function soft_delete($id){
        $customer = Customer::FindOrFail($id);
        $user = User::FindOrFail($customer->user_id);

        $user->delete();
        $customer->delete();
        //Customer::FindOrFail($id)->delete();
        return redirect('customer')->with([
            'flash_message' => 'Klant werd volledig verwijderd.',
            'flash_message_important' => true
        ]);
    }
}
