<?php

namespace App\Http\Middleware;

use Closure;

class IsPatient
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
        if(auth()->user()->role_id == 3)
            return $next($request);
        else
            abort('404');
    }
    }

