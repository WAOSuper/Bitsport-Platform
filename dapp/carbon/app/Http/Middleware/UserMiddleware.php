<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->path();
        if($route) {
            $redirect = "login?redirect=".$route;
        } else {
            $redirect = "login";
        }
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'user')
            return $next($request);
        else
            return redirect($redirect);
    }
}
