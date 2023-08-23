<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserAll()
    {
        $users = User::all();
        return view('backend.user.user_all', compact('users'));
    }

    public function UserAdd()
    {
        return view('backend.user.user_add');
    }

    public function UserStore(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_as' => $request->role_as,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'User Created',
            'alert-type' => 'success'
        );
        return redirect()->route('user')->with($notification);
    }

    public function UserEdit($id, Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('role_as', '0')) {
            User::findOrFail($id)->update([
                'role_as' => '2',
            ]);
            $notification = array(
                'message' => 'User Updated',
                'alert-type' => 'info'
            );
            return redirect()->route('user')->with($notification);
        }
    }

    public function UserUserEdit($id, Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('role_as', '2')) {

            User::findOrFail($id)->update([
                'role_as' => '0',
            ]);
            $notification = array(
                'message' => 'User Updated',
                'alert-type' => 'info'
            );
            return redirect()->route('user')->with($notification);
        }
    }

    public function UserDelete($id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User Deleted',
            'alert-type' => 'info'
        );
        return redirect()->route('user')->with($notification);
    }
}
