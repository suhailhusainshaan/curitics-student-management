<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Support\Facades\View;

class AdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('/');
        }
        if (auth()->user()->role_id != config('constants.ADMIN_ROLE_ID')) {
            return redirect()->route('/');
        }
        $user = Auth::user();
        $user_name = $user->name;
        $user_id = $user->id;
        $user_role = $user->role_id;
        View::share('current_user', $user_name);
        View::share('user_role', $user_role);
        View::share('user_id', $user_id);
        
    

        return $next($request);
    }
}
