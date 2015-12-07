<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if( ! Auth::user()->hasRole('manager_user')){
            return response()->view('errors.403', [
                'request' => $request,
            ], 403);
        }


        return $next($request);
    }
}
