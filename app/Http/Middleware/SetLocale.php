<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        $request->route()->forgetParameter('locale');
        
        return $next($request);
    }
}
