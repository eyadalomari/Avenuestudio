<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $controller, $method): Response
    {
        /*
        if (Auth::check() && (Auth::user()->hasPermission($permission) || Auth::user()->id == 1)) {
            return $next($request);
        }
        dd($controller, $method, Auth::user()->checkHasPermission($controller, $method), Auth::user()->roles);
        */

        if (Auth::check()) {
            $user = Auth::user();

            // Check for permission based on the method
            $hasPermission = $this->hasPermission($user, $controller, $method);

            if ($hasPermission || $user->id == 1) {
                return $next($request);
            }
        }

        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else {
            return abort('403');
        }
    }

    private function hasPermission($user, $controller, $method)
    {
        // If the method is 'store', check for either 'create' or 'edit' permissions
        if ($method == 'store') {
            return $user->checkHasPermission($controller, 'create') || $user->checkHasPermission($controller, 'edit');
        }

        // For other methods, check for specific permission
        return $user->checkHasPermission($controller, $method);
    }
}
