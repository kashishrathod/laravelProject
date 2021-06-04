<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
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
        return view('admin.showdetails.show-all-details', compact('user_all_details'));
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
        // $id = Auth::user()->id;
        // $img = $request->file('profile1');

        // $name = $id . time();
        // $img_ext = $img->clientExtension();
        // $img_name = $name . "." . $img_ext;
        // $location = 'public/' . $id . '/';
        // $last_img = $location . $img_name;
        // $img->move(public_path($location), $img_name);

        $update_user_data = UserDetails::find($id)->update([
            'first_name' => $request->first_name1,
            'last_name' => $request->last_name1,
            'hobby' => $request->hobby1,
            'address' => $request->address1,
            // 'profile_pic' => $last_img,
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
}
