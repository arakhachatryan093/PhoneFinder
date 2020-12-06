<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::paginate(6);
        return response()->view('auth.admin.categories.index', ['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Category::query()->create($request->all());
        return redirect()->route('categories.index')->withSuccess('You have created a new category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $category->update($request->all());
        return redirect()->route('categories.index')->withSuccess('You have succesfully updated category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        foreach ($category->phones as $phone) {
            $phone->update(['category_id' => NULL]);
        }

        $category->delete();

        return redirect()->route('categories.index')->withSuccess('You have successfully deleted a Category!');
    }
}
