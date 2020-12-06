<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $phones = Phone::paginate(4);
        return response()->view('auth.admin.phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return response()->view('auth.admin.phones.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        $phone = new  Phone();
        $phone->name = $request->name;
        $phone->description = $request->description;
        $phone->price = $request->price;
        $phone->category_id = $request->category;
        $path = $request->file('image')->store('phones_images');
        $phone->image = $path;
        if ($phone->save()) {
            return redirect()->route('phones.index')->withSuccess('You have created a new product');
        } else {
            return redirect()->route('phones.index')->withWarning('Some error occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        return response()->view('auth.admin.phones.show', compact('phone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {

        $categories = Category::all();
        return response()->view('auth.admin.phones.form', compact('phone', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        $phone->name = $request->name;
        $phone->category_id = $request->category;
        $phone->description = $request->description;
        $phone->price = $request->price;
        $oldPath = $phone->image;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,jpg,png'
            ]);
            $path = $request->file('image')->store('phones_images');
            $phone->image = $path;
            Storage::delete($oldPath);
        }
        if ($phone->save()) {
            return redirect()->route('phones.index')->withSuccess('You have succesfully updated product');
        } else {
            session()->flash('Something went wrong');
            return redirect()->route('phones.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        if ($phone->delete()) {
            Storage::delete($phone->image);
            return redirect()->route('phones.index')->withSuccess('You have succesfully deleted product');
        } else {
            session()->flash('Something went wrong');
            return redirect()->route('phones.index');
        }
    }
}
