<?php

namespace Bugger\Http\Controllers;

use Bugger\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showUpdateForm($id){
        $user = User::find($id);
        $users = User::all();
        return view('settings')->with('user', $user)->with('users', $users);
    }
    public function updateDetails(Request $request){
        if (!(Hash::check($request->input('current-password'), Auth::user()->password))) {
            return redirect()->back()->withErrors(["Your current password does not matches with the password you provided. Please try again."]);
        }
        if($request->input('new-password') != "") {
            if (strcmp($request->input('current-password'), $request->input('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->withErrors(["New Password cannot be same as your current password. Please choose a different password."]);
            }
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => $request->input('new-password') != "" ? 'required|string|min:6|confirmed' : '',
        ]);

        //Change Password
        $user = Auth::user();
        if($user->fName != $request->fName) {
            $user->fName = $request->fName;
        }
        if($user->lName != $request->lName) {
            $user->fName = $request->lName;
        }
        if($request->input('new-password') != "") {
            $user->password = bcrypt($request->input('new-password'));
        }
        $user->save();

        return redirect()->route('dashboard')->with("alert-info","Information updated successfully !");

    }
}
