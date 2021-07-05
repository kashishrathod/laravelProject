<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function showCategory()
    {
        $edit_candidate_details = Category::first();
        //dd($edit_candidate_details);
        return view('category.category_add', compact('edit_candidate_details'));
    }

    // store category data
    public function addCategory(Request $request)
    {  
        //dd($request);  
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
            ]
        );  
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $count = Category::count();
            if ($count == 0) {
            $category_data = Category::create([
                'category_name' => $request->category,
            ]);
            return response()->json($category_data, 200);
            } else {
            $category_data = Category::first()->update([
                'category_name' => $request->category,
            ]);
            return response()->json($category_data, 200);
            }
        }
        
    }
}
