<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Closure;


class AuthenticatedSessionController extends Controller implements HasMiddleware
{
    
    public static function middleware(): array
{
    return [
        // examples with aliases, pipe-separated names, guards, etc:
        'role_or_permission:manager|edit articles',
        new Middleware('role:users', only: ['index']),
        new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('super-admin'), except:['show']),
        new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete records,api'), only:['destroy']),
    ];
}

    // Get the middleware that should be assigned to the controller.
    // public static function middleware(): array
    // {
    //     return [
    //         function (Request $request, Closure $next) {
    //             return $next($request);
    //         },
    //     ];
    // }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        
   
        // Auth::guard('super-admin')->user();
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $user->assignRole($request->input('roles'));

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
