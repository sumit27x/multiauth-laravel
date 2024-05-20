<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = ['admin', 'employee', 'user'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'admin') {
                    return redirect('/admin/home');
                } elseif ($guard === 'employee') {
                    return redirect('/employee/home');
                } elseif ($guard === 'user') {
                    return redirect('/user/home');
                }
            }
        }

        if ($request->route()->getName() === 'login') {
            return redirect()->route('user.login');
        }
        if ($request->route()->getName() === 'register') {
            return redirect()->route('user.register');
        }
        return $next($request);
    }

    protected function redirectTo(Request $request)
    {

        if($request->routeIs('admin.login')){
            return route('admin.home');
        }
        if($request->routeIs('employee.login')){
            return route('employee.home');
        }
        if($request->routeIs('user.login')){
            return route('user.home');
        }

        if (static::$redirectToCallback) {
            return call_user_func(static::$redirectToCallback, $request);
        }
    }
}
