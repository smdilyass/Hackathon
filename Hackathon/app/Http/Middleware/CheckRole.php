<?php

namespace App\Http\Middleware;

use Closure;
use vendor\laravel\framework\src\Illuminate\Contracts\Auth\Guard;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles){
        if (!Auth::check() || !Auth::user()->hasRole($roles)) {
        if (!auth()->check() || !auth()->user()->hasRole($roles)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}}
