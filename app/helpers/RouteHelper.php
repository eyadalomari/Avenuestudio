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
        if (app()->getLocale() == 'ar') {
            $format = 'dddd, D MMMM YYYY, h:mm:ss A';
        }
        return \Carbon\Carbon::parse($date)->locale(app()->getLocale())->isoFormat($format);
    }
}

if (!function_exists('dateFormatter')) {
    function dateFormatter($date)
    {
        $format = 'dddd, MMMM Do YYYY';
        if (app()->getLocale() == 'ar') {
            $format = 'dddd, D MMMM YYYY';
        }
        return \Carbon\Carbon::parse($date)->locale(app()->getLocale())->isoFormat($format);
    }
}

if (!function_exists('timeFormatter')) {
    function timeFormatter($date)
    {
        return \Carbon\Carbon::parse($date)->locale(app()->getLocale())->isoFormat('h:mm A');
    }
}

if (!function_exists('currencyFormatter')) {
    function currencyFormatter($price)
    {
        return number_format($price, 2) . (app()->getLocale() == 'ar' ? ' د.أ' : ' JD');
    }
}

if (!function_exists('upload_file')) {
    function upload_file($file, $path = 'images/profiles')
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($path);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $fileName);
        return $path . '/' . $fileName;
    }
}
