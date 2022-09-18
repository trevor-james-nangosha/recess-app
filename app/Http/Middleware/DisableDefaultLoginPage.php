<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableDefaultLoginPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->path() == 'login/'){
            return route('loginCustomer');
        }
        return $next($request);
    }
}


// TODO;
// disable the default login page. thought i could use some middleware to get the url and redirect to another route
// but it ain't working
