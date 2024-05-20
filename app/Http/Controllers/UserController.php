<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            return redirect()->intended('/user/home');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required',
            'dob' => 'required|date',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password); 
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->registered_at = now();
        $user->status = true;
        $user->save();

        return redirect()->route('user.login')->with('success', 'Registration successful. Please login.');
    }

    public function home()
    {
        return view('user.home');
    }
}
