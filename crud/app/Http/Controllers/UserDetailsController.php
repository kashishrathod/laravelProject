<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
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
        $user_all_details = UserDetails::get();
        return view('admin.showdetails.show-all-details', compact('user_all_details'));
    }
    // add customer

    public function addCustomer(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|unique:users|max:255',
            ]);
            $email_pass = User::create([
                'email' => $request->email,
                'password' => $request->password,
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

    //show details

    public function showCustomer($id){
        $details_id = UserDetails::find($id);
        return response()->json($details_id, 200);
    }
}
