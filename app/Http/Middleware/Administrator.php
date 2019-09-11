<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
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
        if ($request->user()->userType() !== 'administrator') {
            if ($request->user()->userTypeModel()->id !== $request->route('administrator')->id) {
                abort(403, 'Access denied');
            }
        }

        return $next($request);
    }
}
