<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProductTypeMiddleware
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
        if( ! Auth::user()->hasRole('manager_product_type')){
            return response()->view('errors.403', [
                'request' => $request,
            ], 403);
        }
        return $next($request);
    }
}
