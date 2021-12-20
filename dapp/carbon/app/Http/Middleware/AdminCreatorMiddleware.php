<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AdminCreatorMiddleware
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
        if(Sentinel::check()) {
            $role = Sentinel::getUser()->roles()->first()->slug;
            if(in_array($role, array('admin','creator'), true )) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
