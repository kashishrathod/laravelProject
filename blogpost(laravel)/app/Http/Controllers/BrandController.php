<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function brandAll(){
        $brands = Brand::latest()->paginate(3);
        return view('admin.brand.all_brand', compact('brands'));
    }
}
