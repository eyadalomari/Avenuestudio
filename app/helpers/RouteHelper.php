<?php

if (!function_exists('avenue_route')) {
    function avenue_route($route, $parameters = [], $absolute = true)
    {
        $locale = app()->getLocale();

        return route($route, array_merge($parameters, ['locale' => $locale]), $absolute);
    }
}
