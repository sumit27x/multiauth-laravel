<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/home');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admins,username',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = new Admin();
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password); 
        $admin->save();

        return redirect()->route('admin.login')->with('success', 'Registration successful. Please login.');
    }

    public function home()
    {
        return view('admin.home');
    }


    // ------------------------------------------Register Employee------------------------------
    public function registerEmployee(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:employees',
            'password' => 'required|string',
            'department' => 'required|string',
        ]);
    
        Employee::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'department' => $request->department,
        ]);
    
        return redirect()->route('admin.home')->with('success', 'Employee registered successfully.');
    }



    // ----------------------------------------View ---------------------------------------------
    public function viewEmployees()
    {
        $employees = Employee::all(); // Fetch all employees
        return view('admin.employees', compact('employees'));
    }

    public function viewUsers()
    {
        $users = User::all(); // Fetch all users
        return view('admin.users', compact('users'));
    }

    public function viewQuery()
    {
        $queries = Query::all(); // Fetch all queries

        return view('admin.queries', ['queries' => $queries]);
    }
}
