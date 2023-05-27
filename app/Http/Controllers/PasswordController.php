<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('auth.password-change');
    }

    public function update(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $request->validate([
                'new_password' => 'required|confirmed|min:6',
            ]);
            
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();

            Auth::logout();
            session()->flash('message', 'Password updated, please login again!');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->route('clients.login');
        }else{
            session()->flash('message', 'Old password does not match!');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();            
        }
    }
}
