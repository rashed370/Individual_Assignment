<?php

namespace App\Http\Middleware;

use Closure;

class UserAccessControll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {

        if(!empty($role) && !in_array(auth()->user()->role, $role)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
