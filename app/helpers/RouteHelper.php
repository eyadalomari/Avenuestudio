<?php

if (!function_exists('avenue_route')) {
    function avenue_route($route, $parameters = [], $absolute = true)
    {
        $locale = app()->getLocale();
        
        return route($route, array_merge(['locale' => $locale], $parameters), $absolute);
    }
}

if (!function_exists('dateTimeFormatter')) {
    function dateTimeFormatter($date)
    {
        $format = 'dddd, MMMM Do YYYY, h:mm:ss A';
        if(app()->getLocale() == 'ar'){
            $format = 'dddd, D MMMM YYYY, h:mm:ss A';
        }
        return \Carbon\Carbon::parse($date)->locale(app()->getLocale())->isoFormat($format);
    }
}