<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()) {
            if ($request->user()->password_changed != 1) {
                return redirect(route('password.change', $request->user()->id));
            }
            if ($request->user()->role == 'admin') {
                return $next($request);
            }
        }
        abort(403);
    }
}
