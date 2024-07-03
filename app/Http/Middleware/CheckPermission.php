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
    public function handle(Request $request, Closure $next, $permission): Response
    {
        // if (Auth::check() && (Auth::user()->hasPermission($permission) || Auth::user()->id == 1)) {
        //     return $next($request);
        // }

        list($fullController, $method) = explode('-', $permission);
        $controllerParts = explode('\\', $fullController);
        $controller = end($controllerParts);

        if (Auth::check() && (Auth::user()->checkHasPermission($controller, $method) || Auth::user()->id == 1)) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else {
            return abort('403');
        }
    }
}
