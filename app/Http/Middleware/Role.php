<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (in_array(auth()->user()->role->name, $roles)) {
            return $next($request);
        }

        foreach ($roles as $role) {
            if ($role === 'admin') {
                return redirect()->route('dashboard.donatur');
            } else if ($role === 'donatur') {
                return redirect()->route('dashboard.admin');
            }
        }
    }
}
