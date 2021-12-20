<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class CuratorMiddleware
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
        if (Sentinel::check() && Sentinel::getUser()->is_curator) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
