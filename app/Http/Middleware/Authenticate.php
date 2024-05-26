<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {   
        return $request->expectsJson() ? null : route('login');
    }
    
    // CHECK IF LOGIN IS LOGGED IN OR NOT, AND REDIRECT TO THE CORRESPONDING PAGES
    // public function handle(Request $request, Closure $next)
    // {
    //     if (!Auth::check()) {
    //         return redirect('/login'); // Change '/login' to your actual login route
    //     }

    //     return $next($request);
    // }
}
