<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if($request->user()->type == 'ADMIN'){
                    return redirect('/admin/dashboard');
                }elseif ($request->user()->type == 'CUSTOMER') {
                    return redirect('/customer/dashboard');
                }elseif ($request->user()->type == 'PARTICIPANT') {
                    return redirect('participants/dashboard');
                }else{
                    return redirect(RouteServiceProvider::PROFILE);
                }
            }
        }

        return $next($request);
    }
}

// TODO;
// have custom redirects when authenticated depending on the user.
// when authenticated each person should go to their own profile page.
