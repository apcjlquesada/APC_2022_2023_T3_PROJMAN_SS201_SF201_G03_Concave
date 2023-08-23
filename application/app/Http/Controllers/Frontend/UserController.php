<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Profile()
    {
        return view('frontend.user.profile');
    }

    public function ProfileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'province' => $request->province,
                'zip_code' => $request->zip_code
            ]
        );

        $notification = array(
            'message' => 'Profile Updated',
            'alert-type' => 'info'
        );

        return redirect()->route('profile')->with($notification);
    }

    public function ChangePassword()
    {
        return view('frontend.user.change_password');
    }

    public function ChangePasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            $notification = array(
                'message' => 'Password Changed',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);

        }else{

            $notification = array(
                'message' => 'Current Password does not match with Old Password',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
