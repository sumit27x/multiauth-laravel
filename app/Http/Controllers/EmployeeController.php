<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\User;


class EmployeeController extends Controller
{
    public function showLoginForm()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->intended('/employee/home');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('employee.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:employees,username',
            'password' => 'required|confirmed',
        ]);

        $employee = new Employee();
        $employee->username = $request->username;
        $employee->password = Hash::make($request->password);
        $employee->department = $request->department;
        $employee->save();

        return redirect()->route('employee.login')->with('success', 'Registration successful. Please login.');
    }

    public function home()
    {
        return view('employee.home');
    }

    public function viewUsers()
    {
        $users = User::all(); // Fetch all users from UserDetail model
        return view('employee.users', compact('users'));
    }
}
