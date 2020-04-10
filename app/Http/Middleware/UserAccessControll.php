<?php

namespace App\Http\Middleware;

use Closure;

class UserAccessControll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!empty($role) && auth()->user()->role!=$role) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
