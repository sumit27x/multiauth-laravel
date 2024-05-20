<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueryController;

Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminController::class, 'login']);
    Route::get('admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('admin/register', [AdminController::class, 'register']);

});

Route::post('/admin/register-employee', [AdminController::class, 'registerEmployee'])
->name('admin.register.employee')
->middleware('auth:admin');

Route::group(['middleware' => 'guest:employee'], function () {
    Route::get('employee/login', [EmployeeController::class, 'showLoginForm'])->name('employee.login');
    Route::post('employee/login', [EmployeeController::class, 'login']);
    Route::get('employee/register', [EmployeeController::class, 'showRegisterForm'])->name('employee.register');
    Route::post('employee/register', [EmployeeController::class, 'register']);
});

Route::group(['middleware' => 'guest:user'], function () {
    // Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
    Route::get('user/login', [UserController::class, 'showLoginForm'])->name('user.login');
    Route::post('user/login', [UserController::class, 'login']);
    Route::get('user/register', [UserController::class, 'showRegisterForm'])->name('user.register');
    Route::post('user/register', [UserController::class, 'register']);
});

// Query Routes
Route::resource('queries', QueryController::class);


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
    Route::post('/admin/register-employee', [AdminController::class, 'registerEmployee'])->name('admin.registerEmployee');
    Route::get('/admin/employees', [AdminController::class, 'viewEmployees'])->name('admin.employees');
    Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
    Route::get('/admin/queries', [QueryController::class, 'index'])->name('admin.queries');
});

Route::group(['middleware' => 'auth:employee'], function () {
    Route::get('/employee/home', [EmployeeController::class, 'home'])->name('employee.home');
    Route::get('/employee/users', [EmployeeController::class, 'viewUsers'])->name('employee.users');
    Route::get('/employee/queries', [QueryController::class, 'employeeIndex'])->name('employee.queries');
    Route::patch('/queries/{query}/status', [QueryController::class, 'updateStatus'])->name('queries.updateStatus');
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/user/home', [UserController::class, 'home'])->name('user.home');
    Route::get('/queries/create', [QueryController::class, 'create'])->name('queries.create');
    Route::post('/queries', [QueryController::class, 'store'])->name('queries.store');
    
});


// --------------------------------------------------------------------------------------

Route::post('/logout', function () {
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    } elseif (Auth::guard('employee')->check()) {
        Auth::guard('employee')->logout();
    } elseif (Auth::guard('user')->check()) {
        Auth::guard('user')->logout();
    }
    return redirect('/');
})->name('logout');


// -----------------------------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
