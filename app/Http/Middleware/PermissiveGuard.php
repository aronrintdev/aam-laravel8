<?php

namespace App\Http\Middleware;

use Closure;

class PermissiveGuard
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
        if (\Auth::guard('backend')->check()) {
            $user = \Auth::guard('backend')->user();
            \Auth::shouldUse('backend');
            return $next($request);
        }
        if(\Auth::guard('api')->check()) {
            \Auth::shouldUse('backend');
            return $next($request);
        }
        return $next($request);
    }
}
