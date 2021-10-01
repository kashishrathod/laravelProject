<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // // view listing page for permission
    public function permissionIndex() {
        $permission_data = Permission::get();
        return view('permission.permission-listing', compact('permission_data'));
    }

    // create permission page show
    public function createPermission() {
        return view('permission.create-permission');
    }

    // delete permission
    public function permissionDelete($id) {
        Permission::find($id)->delete();
        return redirect()->route('permission')->with('success', 'Permission delete successfully!');
    }

    // edit permission page show
    public function permissionEdit($id) {
        $permission_data = Permission::find($id);
        return view('permission.create-permission', compact('permission_data'));
    }

    // create and edit permission
    public function permissionStore(Request $request, $id = null) {
        $validated = $request->validate(
            [
                'name' => 'required|unique:permissions',
                'route' => 'required',
            ],
            [
                'name.required' => 'field is required!',
            ]
        );
        if(!empty($id)) {
            $permission_create = Permission::find($id);
            $permission_create->name = $request->name;
            $permission_create->route = $request->route;
            $permission_create->updated_at = now();
            $permission_create->save();
            return redirect()->route('permission')->with('success', 'Permission updated successfully!');
        } else {
            $permission_create = new Permission;
            $permission_create->name = $request->name;
            $permission_create->route = $request->route;
            $permission_create->created_at = now();
            $permission_create->updated_at = now();
            $permission_create->save();
            return redirect()->route('permission')->with('success', 'Permission added successfully!');
        }
            
    }
}
