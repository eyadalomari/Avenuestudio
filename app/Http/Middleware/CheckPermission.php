<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $route = Route::currentRouteName();
        $action = $this->getActionFromRoute($route);

        dd($user->permissions);
        if (!$user->permissions->contains('name', $action)) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }

    protected function getActionFromRoute($route)
    {
        $routeParts = explode('.', $route);

        // Assuming route naming convention is "resource.action"
        if (count($routeParts) == 2) {
            return ucfirst($routeParts[0]) . '-' . $routeParts[1];
        }

        return null;
    }
}
