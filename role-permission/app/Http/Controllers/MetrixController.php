<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\RoleNew;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class MetrixController extends Controller
{
    // return to matrix view page
    public function metrixIndex() {
        $role = RoleNew::get();
        $permission = Permission::get();
        return view('metrix.metrix-listing', compact('role', 'permission'));
    }

    // store the matrix data
    public function metrixStore(Request $request) {
        foreach($request->role as $role) {
            $store_data = new RolePermission;
            $data = explode(',', $role);
            $store_data->role_id = $data[0];
            $store_data->permission_id = $data[1];
            $store_data->save();
        }
        return redirect()->back();
    }
}
