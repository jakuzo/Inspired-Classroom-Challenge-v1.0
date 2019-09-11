<?php

namespace App\Http\Middleware;

use Closure;

class Teacher
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
            if ($request->user()->userTypeModel()->id !== $request->route('teacher')->id) {
                abort(403, 'Access denied');
            }
        }

        return $next($request);
    }
}
