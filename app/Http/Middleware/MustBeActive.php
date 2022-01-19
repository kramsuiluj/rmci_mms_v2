<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustBeActive
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
        if (auth()->user()->profile->is_active !== 1) {
            return redirect(route('student.edit', auth()->user()->id));
        }

        return $next($request);
    }
}
