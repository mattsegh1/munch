<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\User;


use Illuminate\Http\Response;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::join('users', 'customers.user_id', '=', 'users.id')
            ->select('customers.*', 'users.username AS username', 'users.email AS user_email', 'users.avatar_url as avatar_url')
            ->orderBy('first_name')
            ->get();

        return $customers;


        //return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        if ($customer->save()) {
            return response()
                ->json($customer)
                ->setStatusCode(Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $customer->username = User::FindOrFail($customer->user_id)->username;
        $customer->user_email = User::FindOrFail($customer->user_id)->email;
        $customer->avatar_url = User::FindOrFail($customer->user_id)->avatar_url;

        return $customer ?: response()
            ->json([
                'error' => "Customer `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $rules = [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'email' => 'required',
        ];

        $this->validate($request, $rules);

        $customer = Customer::find($id);
        $user = User::find($customer->user_id);



        $customer->fill($request->input());
        $user->fill($request->input());


        $customer->save();
        $user->save();



    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->delete()) {
                return response()
                    ->json($post)
                    ->setStatusCode(Response::HTTP_OK);
            }
            return response()
                ->json([
                    'error' => "Post `${id}` could not be deleted",
                ])
                ->setStatusCode(Response::HTTP_CONFLICT);
        }
        return response()
            ->json([
                'error' => "Post `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
