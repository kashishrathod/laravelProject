<?php

namespace App\Http\Controllers;

use App\Models\RoleNew;
use Illuminate\Http\Request;

class RoleNewController extends Controller
{
    // view listing page for role
    public function roleIndex() {
        $role_data = RoleNew::get();
        return view('rolenew.role-listing', compact('role_data'));
    }

    // create page show
    public function roleCreate() {
        return view('rolenew.create-role');
    }

    // edit
    public function roleEdit($id) {
        $role_data = RoleNew::find($id); 
        return view('rolenew.edit-role', compact('role_data'));
    }

    // delete the role
    public function roleDelete($id) {
        RoleNew::find($id)->delete();
        return redirect()->route('role.index')->with('success', 'Role Deleted successfully!');
    }

    // create and update
    public function roleStore(Request $request, $id = null) {
        $validated = $request->validate(
            [
                'name' => 'required|unique:role_news',
            ],
            [
                'name.required' => 'field is required!',
            ]
        );

        if(!empty($id)) {
            $role_edit = RoleNew::find($id);
            $role_edit->name = $request->name;
            $role_edit->updated_at = now();
            $role_edit->save();
            return redirect()->route('role.index')->with('success', 'Role updated successfully!');
        } else {
            $role_create = new RoleNew;
            $role_create->name = $request->name;
            $role_create->created_at = now();
            $role_create->updated_at = now();
            $role_create->save();
            return redirect()->route('role.index')->with('success', 'Role added successfully!');
        }
    }
}
