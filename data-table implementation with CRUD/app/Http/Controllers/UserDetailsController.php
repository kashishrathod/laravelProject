<?php

namespace App\Http\Controllers;

use App\Models\Multipics;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDetailsController extends Controller
{
    public function userData()
    {
        $user_id = Auth::user()->id;
        $user_details = UserDetails::find($user_id);

        if ($user_details) {
            return view('admin.userdetails.edit-user', compact('user_details'));
        } else {
            return view('admin.userdetails.userprofile');
        }
    }
    public function userEdit()
    {
        $id = Auth::user()->id;
        $user_details = UserDetails::find($id);
        return view('admin.userdetails.edit-user', compact('user_details'));
    }

    public function userProfileData(Request $request)
    {
        $id = Auth::user()->id;
        $img = $request->file('profile');
        $name = $id . time();
        $img_ext = $img->clientExtension();
        $img_name = $name . "." . $img_ext;
        $location = '/public/' . $id . '/';
        $last_img = $location . $img_name;
        $img->move(public_path($location), $img_name);

        UserDetails::create([
            'user_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'hobby' => $request->hobby,
            'address' => $request->address,
            'profile_pic' => $last_img,
            'education' => $request->education,
        ]);
        return redirect()->route('h')->with('success', 'product added successfully!');
    }
    public function updateDetails(Request $request, $id)
    {
        $id = Auth::user()->id;
        $img = $request->file('profile');
        $name = $id . time();
        $img_ext = $img->clientExtension();
        $img_name = $name . "." . $img_ext;
        $location = '/public/' . $id . '/';
        $last_img = $location . $img_name;
        $img->move(public_path($location), $img_name);

        UserDetails::find($id)->update([
            'user_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'hobby' => $request->hobby,
            'address' => $request->address,
            'profile_pic' => $last_img,
            'education' => $request->education,
        ]);
        return redirect()->route('h')->with('success', 'product added successfully!');
    }
    // show all details

    public function showAllDetails()
    {
        $user_all_details = UserDetails::orderBy('created_at', 'desc')->get();
        $roles = Role::all();
        return view('admin.showdetails.show-all-details', compact('user_all_details', 'roles'));
    }
    // add customer

    public function addCustomer(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|unique:users|max:255',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'hobby' => 'required',
                'address' => 'required',
                'education' => 'required',
                'password' => $this->passwordRules(),
                'profile' => 'required|image|mimes:jpeg,png,jpg',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $email_pass = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->first_name,
                'role_id' => $request->role,
            ]);
            $userid = $email_pass->id;

            $id = Auth::user()->id;
            $img = $request->file('profile');

            $name = $id . time();
            $img_ext = $img->clientExtension();
            $img_name = $name . "." . $img_ext;
            $location = 'public/' . $id . '/';
            $last_img = $location . $img_name;
            $img->move(public_path($location), $img_name);

            $user_data = UserDetails::create([
                'user_id' => $userid,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'hobby' => $request->hobby,
                'address' => $request->address,
                'profile_pic' => $last_img,
                'education' => $request->education,
            ]);

            $user_details = UserDetails::with(['UserData'])->where('user_id', $userid)->first();
            return response()->json($user_details, 200);
        }
    }

    //show details

    public function showCustomer(Request $request, $id)
    {
        $details_id = UserDetails::with(['UserData'])->find($id);
        return response()->json($details_id, 200);
    }

    // get customer data

    public function getCustomerData($id)
    {
        $data = UserDetails::find($id);
        return response()->json($data);
    }

    // update
    public function updateCustomerData(Request $request, $id)
    {
        $update_user_data = UserDetails::find($id)->update([
            'first_name' => $request->first_name1,
            'last_name' => $request->last_name1,
            'hobby' => $request->hobby1,
            'address' => $request->address1,
            'education' => $request->education1,
        ]);
        return response()->json($update_user_data, 200);
    }

    //delete

    public function getDeleteData($id)
    {
        $get_delete_data = UserDetails::find($id);
        return response()->json($get_delete_data);
    }
    public function deleteCustomerData(Request $request, $id)
    {
        $delete_data = UserDetails::find($id)->delete();
        return response()->json($delete_data);
    }
    protected function passwordRules()
    {
        return ['required', 'string', new Password];
    }

    // multiple pics upload

    public function multiPics()
    {
        $images = Multipics::all();
        return view('admin.multipics.multi', compact('images'));
    }

    public function homePage()
    {
        $users = DB::table('users')->get();
        return view('dashboard', compact('users'));
    }
    // show data-table data
    public function view() {
        $roles = Role::all();
        return view('admin.datatable_jquery.datatable', compact('roles'));
    }

    // get all the data of user table
    public function allTableData()
    {
        $all_table_data = User::all();
        $data1 = array();
        $data = array();
        $i = 1;
        foreach($all_table_data as $userdata) {
            $id = $i;
            $first_name = $userdata->name;
            $email = $userdata->email;
            $created_at = Carbon::parse($userdata->created_at)->diffForHumans();
            $action = "<a class='btn btn-info dataedit' data-toggle='modal' data-target='#editdetails' data-user-id='".$userdata->id."'>Edit</a> <a class='btn btn-danger datadelete' data-toggle='modal' data-target='#deletedetails' data-delete-id='".$userdata->id."'>Delete</a>";
            $data1[] = array(
                "id" => $id,
                "first_name" => $first_name,
                "email" => $email,
                "created_at" => $created_at,
                "action" => $action
              );
            $i++;
        }
        $columns = array(
            'data' => $data1
        );
        echo json_encode($columns);
    }
    // create new user
    public function createNewUser(Request $request)
    {
        $add_data = User::create([
            'email' => $request->useremail,
            'password' => Hash::make($request->userpassword),
            'name' => $request->username,
            'role_id' => $request->userrole,
        ]);   
        return response()->json($add_data, 200);
    }
    // find id for update user details
    public function editUser($id) {
        $get_id = User::find($id);
        return response()->json($get_id, 200);
    }
    // update user details
    public function updateUser(Request $request, $id) {
        $update = User::find($id)->update([
            'name' => $request->username1,
            'role_id' => $request->userrole1,
        ]);
        return response()->json($update, 200);
    }
    // find id for delete user
    public function getDeleteUserId($id) {
        $get_delete_id = User::find($id);
        return response()->json($get_delete_id);
    }
    // delete user
    public function deleteUser(Request $request, $id) {
        $delete = User::find($id)->delete();
        return response()->json($delete, 200);
    }
}
