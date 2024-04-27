<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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

        if (auth()->check()) {
            if (auth()->user()->user_role == 'admin'){
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->route('login');
            }
        }
            return redirect()->route('login');

    }
}
