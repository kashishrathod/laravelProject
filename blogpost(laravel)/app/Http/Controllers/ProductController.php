<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
 
   // show all the product
    public function productAll() {
        $all_product_data = Product::get();
        return view('product.all_product', compact('all_product_data'));
    }
   
    // redirect to create product page
    public function createProduct() {
        return view('product.create_product');
    }

    // add product
    public function productAdd(Request $request) {
        $validated = $request->validate(
            [
                'price' => 'required|digits:3',
            ],
            [
                'price.digits' => 'only digits are allowed!',
            ]
        );
        Product::create([
            'product_name' => $request->Product_name,
            'description' => $request->description,
            'rating' => $request->rating,
            'price' => $request->price,
            'available' => $request->available,
        ]);
        return redirect()->route('product')->with('success', 'product added successfully!');


    }

    // edit page redirection
    public function editProduct($id) {
        $products = Product::find($id);
        return view('product.edit_product', compact('products'));
    }

    // update product
    public function productUpdate(Request $request, $id) {
        $products = Product::find($id)->update([
            'product_name' => $request->Product_name,
            'description' => $request->description,
            'rating' => $request->rating,
            'price' => $request->price,
            'available' => $request->available,
        ]);
        return redirect()->route('product')->with('success', 'product updated successfully!');

    }

    // delete product
    public function productDelete($id){
        $products = Product::find($id)->delete();
        return Redirect()->back()->with('success', 'product deleted successfully!');
    }

}
