<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Phone;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }

    public function categoryPhones($id)
    {
        $category = Category::query()->findOrFail($id);
        $phones = $category->phones;
        return view('category_products', compact('phones'));
    }

    public function comparePhones(Request $request)
    {
        $phone = Phone::query()->findOrFail($request->id);
        if ($phone) {
            return response()->json([
                'phone' => $phone
            ]);
        } else {
            return response()->json([
                'message' => 'Some error occured!'
            ]);
        }
    }

    public function phonesInfo(Request $request)
    {

        $first_phone = Phone::query()->findOrFail($request->first_id);
        $second_phone = Phone::query()->findOrFail($request->second_id);
        return response()->view('compare', [
            'first_phone' => $first_phone,
            'second_phone' => $second_phone
        ]);
    }

    public function showPhoneDetails($id)
    {
        $phone = Phone::query()->findOrFail($id);
        return view('show', compact('phone'));
    }
}
