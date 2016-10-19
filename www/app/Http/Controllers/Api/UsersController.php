<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Customer;

use Illuminate\Http\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return User::all();
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
            'name' => 'required|unique:products|min:2|max:255',
            'category_id' => 'required|int',
            'manufacturer_id' => 'required|int',
            'description' => 'required|min:5|max:1500',
            'price' => 'required|regex:/[\d]{2}.[\d]{2}/|min:1|max:10',
            'calories' => 'required|int|min:0'
        ];

        $this->validate($request, $rules);

        $product = new Product($request->only(['name', 'category_id', 'manufacturer_id', 'description', 'price', 'calories']));

        if ($product->save()) {
            return response()
                ->json($product)
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
        $product = Product::find($id);
        $product->manufacturer_name = Manufacturer::FindOrFail($product->manufacturer_id)->name;
        $product->category_name = Category::FindOrFail($product->category_id)->name;

        $avgRating = round(Product::AllRatings($id)->avg('value'),2);

        if(!is_numeric($avgRating)){
            $product->avg_rating = "Geen waarderingen door de gebruiker(s).";
        }
        else{
            $product->avg_rating = round($avgRating/2);
        }

        return $product ?: response()
            ->json([
                'error' => "Product `${id}` not found",
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
            'name' => 'required|min:2|max:255',
            'category_id' => 'required|int',
            'manufacturer_id' => 'required|int',
            'description' => 'required|min:5|max:1500',
            'price' => 'required|regex:/[\d]{2}.[\d]{2}/|min:1|max:10',
            'calories' => 'required|int|min:0',
            'quantity' => 'required|int|min:0'
        ];

        $this->validate($request, $rules);

        $product = Product::find($id);

        $product->fill($request->input());

        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->delete()) {
                return response()
                    ->json($product)
                    ->setStatusCode(Response::HTTP_OK);
            }

            return response()
                ->json([
                    'error' => "Product `${id}` could not be deleted",
                ])
                ->setStatusCode(Response::HTTP_CONFLICT);
        }

        return response()
            ->json([
                'error' => "Product `${id}` not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
