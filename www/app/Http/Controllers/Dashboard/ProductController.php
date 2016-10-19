<?php

namespace App\Http\Controllers\Dashboard;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Category;
use App\Models\Tax;
use App\Models\Product_history;
use App\Models\Discount;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $request->session()->forget('redirect_url');

        //fetches the data from the querystring.
        $sort = $request->input('sort');
        $filter = $request->input('filter');
        $searchby = $request->input('searchby');
        $search = $request->input('search');
        //return $search;

        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('manufacturers', 'products.manufacturer_id', '=', 'manufacturers.id')
            ->leftjoin('discounts', 'products.discount_id', '=', 'discounts.id')
            ->join('taxes', 'products.tax_id', '=', 'taxes.id')
            ->select('products.*',
                'categories.name AS category_name', 'manufacturers.name AS manufacturer_name',
                'discounts.percentage AS discount', 'discounts.discount_start', 'discounts.discount_end',
                'taxes.tax_rate');

        //Search options
        if ($search && $searchby) {
            $products->where($searchby, 'LIKE', "%" . $search . "%");
        }

        //sort and filter options
        if ($sort && $filter) {
            $products = $products
                ->orderby($sort)
                ->where('categories.name', '=', $filter)
                ->get();
        } else if ($sort) {
            $products = $products->orderby($sort)->get();
        } else if ($filter) {
            $products = $products->where('categories.name', '=', $filter)->get();
        } else {
            //default sorting if no other filtering/sorting is given.
            $products = $products->orderby('name')->get();
        }


        $categories_list = Category::pluck('name');

        return view('dashboard.products.overview', compact('products', 'categories_list'));
    }

    // Shows resource form for creating a new resource
    public function create(Request $request)
    {
        $request->session()->put('redirect_url', '/product/create');

        $categories = Category::pluck('name', 'id');
        $manufacturers = Manufacturer::pluck('name', 'id');
        $taxes = Tax::pluck('title', 'id');
        $discounts = Discount::where('discount_end', '>=', date('Y-m-d'))
            ->pluck('name', 'id');
        $discounts[0] = "(geen)";

        return view('dashboard.products.add', compact('categories', 'discounts', 'manufacturers', 'taxes'));
    }

    // Creates new resource and persists it to the DB
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:products|min:2|max:255',
            'category_id' => 'required|int',
            'manufacturer_id' => 'required|int',
            'description' => 'required|min:5|max:1500',
            'price' => 'required|numeric|min:0.01',
            'calories' => 'required|int|min:0',
            'tax_id' => 'required|int|min:0',
            'image' => 'required|mimes:jpeg,bmp,png,jpg,gif'
        ];

        $this->validate($request, $rules);

        if ($request->get('discount_id') != 0) {
            $discount_id = $request->get('discount_id');
        } else {
            $discount_id = null;
        }


        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $destinationPath = 'uploaded';
            $fileName = sha1_file($file->getRealPath()) . '.' . $file->guessExtension();
            $file->move($destinationPath, $fileName);

            Product::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'quantity' => 0,
                'calories' => $request->get('calories'),

                'manufacturer_id' => $request->get('manufacturer_id'),
                'category_id' => $request->get('category_id'),
                'tax_id' => $request->get('tax_id'),
                'discount_id' => $discount_id,
                'preview_url' => $destinationPath . DIRECTORY_SEPARATOR . $fileName,
            ]);
        }

        return redirect('product')->with([
            'flash_message' => 'Product toegevoegd.',
            'flash_message_important' => false
        ]);
    }

    // Show details form (of given id item)
    public function show($id)
    {
        $product = Product::FindOrFail($id);
        $product->manufacturer_name = Manufacturer::FindOrFail($product->manufacturer_id)->name;
        $product->category_name = Category::FindOrFail($product->category_id)->name;

        //$avgRating = round(Product::AllRatings($id)->avg('value'),2);

        $product->ratings = Product::allRatings($id)->first();

        //$month = date('m', strtotime("first day of -1 month"));
        $priceHistory = Product_history::ProductHistory($id)->pluck('price')->toArray();
        $stockHistory = Product_history::ProductHistory($id)->pluck('quantity')->toArray();
        $timeStamps = Product_history::ProductHistory($id)->pluck('created_at')->toArray();

        $discount = Discount::find($product->discount_id);

        $tax = Tax::FindOrFail($product->tax_id);


        return view('dashboard.products.product',
            compact('product', 'discount', 'tax',
                'priceHistory', 'stockHistory', 'timeStamps'));

    }

    // Show editing form
    public function edit($id, Request $request)
    {

        $request->session()->put('redirect_url', '/product/'.$id.'/edit');

        $product = Product::FindOrFail($id);
        $categories = Category::pluck('name', 'id');
        $manufacturers = Manufacturer::pluck('name', 'id');
        $taxes = Tax::pluck('title', 'id');
        $discounts = Discount::where('discount_end', '>=', date('Y-m-d'))
            ->pluck('name', 'id');
        $discounts[0] = "(geen)";

        return view('dashboard.products.edit', compact('product', 'categories', 'discounts', 'manufacturers', 'taxes'));

    }

    // Persists new data to given id item to the DB
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:2|max:255',
            'category_id' => 'required|int',
            'manufacturer_id' => 'required|int',
            'description' => 'required|min:5|max:1500',
            'price' => 'required|numeric|min:0.01',
            'calories' => 'required|int|min:0',
            'quantity' => 'required|int|min:0',
            'image' => 'mimes:jpeg,bmp,png,jpg,gif'
        ];

        $this->validate($request, $rules);

        $prod = Product::FindOrFail($id);
        $prod->price = $request->get('price');
        $prod->quantity = $request->get('quantity');

        if ($prod->isDirty()) {
            $prod_changes = [
                'product_id' => $id,
                'price' => $request->get('price'),
                'quantity' => $request->get('quantity'),
            ];

            Product_history::create($prod_changes);
        }

        if ($request->file('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $destinationPath = 'uploaded';
            $fileName = sha1_file($file->getRealPath()) . '.' . $file->guessExtension();
            $file->move($destinationPath, $fileName);

            $prod->preview_url = $destinationPath . DIRECTORY_SEPARATOR . $fileName;
        }

        $prod->name = $request->get('name');
        $prod->description = $request->get('description');
        $prod->calories = $request->get('calories');

        $prod->manufacturer_id = $request->get('manufacturer_id');
        $prod->category_id = $request->get('category_id');
        $prod->tax_id = $request->get('tax_id');

        if ($request->get('discount_id') != 0) {
            $prod->discount_id = $request->get('discount_id');
        } else {
            $prod->discount_id = null;
        }
        $prod->save();

        return redirect('product')->with([
            'flash_message' => 'Product bijgewerkt.',
            'flash_message_important' => false
        ]);
    }

    // Soft deletes item with given id in DB.
    public function soft_delete($id)
    {
        Product::FindOrFail($id)->delete();

        return redirect('product')->with([
            'flash_message' => 'Product verwijderd.',
            'flash_message_important' => true
        ]);
    }


}
