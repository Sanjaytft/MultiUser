<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);

        if (Auth::check())
        {
        $user = Auth::user();
        // if($user->hasRole(['super-admin'])) {
        //     if (Auth::user()->role == 'super-admin') {
        //  
        if($user->hasRole(['super-admin', 'admin']))  {
        return $next($request);
            }
            abort(403, 'User does not have correct roles');
        }
        abort(401);
        }

    }

