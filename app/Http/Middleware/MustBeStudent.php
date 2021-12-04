<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustBeStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(auth()->user()->profile_type !== 'App\Models\StudentProfile', 403);

        return $next($request);
    }
}
