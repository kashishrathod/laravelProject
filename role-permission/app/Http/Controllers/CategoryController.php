<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function categoryAll()
    {
        // $displaycategory = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(3);
        $displaycategory = Category::latest()->paginate(3);
        $trash_data = Category::onlyTrashed()->latest()->paginate(2);
        return view('admin.category.allcategory', compact('displaycategory', 'trash_data'));
    }

    public function categoryadd(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',
            ],
            [
                'category_name.required' => 'field is required!',
            ]
        );

        Category::create([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $category = array();
        // $category['category_name'] = $request->category_name;
        // $category['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($category);

        return redirect()->back()->with('success', 'category added successfully!');
    }

    public function categoryEdit($id)
    {
        // $categories = DB::table('categories')->where('id', $id)->first();
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }
    public function categoryUpdate(Request $request, $id)
    {
        $categories = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // $categories = DB::table('categories')->where('id', $id)->update($data);


        return redirect()->route('category')->with('success', 'category updated successfully!');
    }

    public function softDelete($id)
    {
        $delete_category = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'category deleted successfully!');
    }

    public function restore($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'category restore successfully!');
    }

    public function pdelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'category deleted permenantly!');
    }
}
