<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::select('*');
        $sort = $request->input('sort');
        $search = $request->input('search');

        if($search){
            $categories = $categories->where('name','LIKE','%'.$search.'%');
        }
        if($sort)
        {
            $categories->orderby($sort);
        }
        $categories = $categories->get();


        return view('dashboard.categories.overview', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.add');
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
            'name' => 'required|string|unique:categories|min:3|max:25',
            'description' => 'required|string|min:3|max:255'
        ];

        $this->validate($request, $rules);

        Category::create($request->all());

        return redirect('category')->with([
            'flash_message' => 'Categorie aangemaakt.',
            'flash_message_important' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $category = Category::findorfail($id);

        //return compact('category');
        return view('dashboard.categories.category', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);

        return view('dashboard.categories.edit', compact('category'));
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
            'name' => 'required|string|min:3|max:25',
            'description' => 'required|string|min:3|max:255'
        ];

        $this->validate($request, $rules);

        Category::findorfail($id)
        ->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect('category')->with([
            'flash_message' => 'Categorie bijgewerkt.',
            'flash_message_important' => true
        ]);
    }

    // Soft deletes item with given id in DB.
    public function soft_delete($id){
        Category::FindOrFail($id)->delete();
        return redirect('category')->with([
            'flash_message' => 'Categorie verwijderd.',
            'flash_message_important' => true
        ]);
    }

    // Restores deleted item with given id in DB.
    public function restore($id){
        Category::withTrashed()->FindOrFail($id)->restore();
        return redirect('category')->with([
            'flash_message' => 'Categorie herstelt.',
            'flash_message_important' => true
        ]);
    }
}
