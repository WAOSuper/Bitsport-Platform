<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SuperMiddleware
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
            if(in_array($role, array('admin','superadmin'), true )) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
