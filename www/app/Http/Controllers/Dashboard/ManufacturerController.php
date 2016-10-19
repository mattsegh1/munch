<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        //fetches the data from the querystring.
        $sort = $request->input('sort');
        $search = $request->input('search');

        $manufacturers = Manufacturer::select('*');


        if($search)
        {
            $manufacturers = $manufacturers->Where("name", 'LIKE', "%".$search."%");
        }

        if($sort){
            $manufacturers = $manufacturers->orderby($sort)->get();
        }
        else{
            //default sorting if no other filtering/sorting is given.
            $manufacturers = $manufacturers->orderby('name')->get();
        }

        return view('dashboard.manufacturers.overview', compact('manufacturers'));
    }

    // Shows resource form for creating a new resource
    public function create()
    {
        return view('dashboard.manufacturers.add');
    }

    // Creates new resource and persists it to the DB
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:manufacturers|min:3|max:255',
            'logo' => 'required|mimes:jpeg,bmp,png,jpg,gif',
        ];

        $this->validate($request, $rules);


        if ($request->file('logo')->isValid()) {
            $file = $request->file('logo');
            $destinationPath = 'uploaded';
            $fileName = sha1_file($file->getRealPath()).'.'.$file->guessExtension();
            $file->move($destinationPath, $fileName);

            Manufacturer::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'quantity' => 0,
                'calories' => $request->get('calories'),

                'manufacturer_id' => $request->get('manufacturer_id'),
                'category_id' => $request->get('category_id'),
                'tax_id' => $request->get('category_id'),
                'logo_url' => $destinationPath . DIRECTORY_SEPARATOR . $fileName,
            ]);
        }

        return redirect('manufacturer')->with([
            'flash_message' => 'Producent toegevoegd.',
            'flash_message_important' => false
        ]);
    }

    // Show details form (of given id item)
    public function show($id)
    {
        $manufacturer = Manufacturer::FindOrFail($id);
        $products = Manufacturer::allProducts($id)->get();

        return view('dashboard.manufacturers.manufacturer', compact('manufacturer', 'products'));

    }

    // Show editing form
    public function edit($id)
    {
        $manufacturer = Manufacturer::FindOrFail($id);

        return view('dashboard.manufacturers.edit', compact('manufacturer'));

    }

    // Persists new data to given id item to the DB
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3|max:255',
        ];

        $this->validate($request, $rules);

        $man = Manufacturer::find($id);
        $man->name = $request->get('name');

        if($request->file('logo') && $request->file('logo')->isValid())
        {
            $file = $request->file('logo');
            $destinationPath = 'uploaded';
            $fileName = sha1_file($file->getRealPath()).'.'.$file->guessExtension();
            $file->move($destinationPath, $fileName);

            $man->logo_url = $destinationPath . DIRECTORY_SEPARATOR . $fileName;
        }

        $man->save();


        return redirect('manufacturer')->with([
            'flash_message' => 'Producent bijgewerkt.',
            'flash_message_important' => false
        ]);
    }

    // Show confirm dialog for deleting item.
    public function delete($id)
    {
        $manufacturer = Manufacturer::FindOrFail($id);

        return view('dashboard.manufacturers.delete', $manufacturer);
    }

    // Soft deletes item with given id in DB.
    public function soft_delete($id)
    {
        Manufacturer::FindOrFail($id)->delete();

        return redirect('manufacturer')->with([
            'flash_message' => 'Producent verwijderd.',
            'flash_message_important' => false
        ]);
    }
}
