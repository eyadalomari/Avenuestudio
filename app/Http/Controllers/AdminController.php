<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $controller = class_basename(request()->route()->getControllerClass());
        $method = request()->route()->getActionMethod();

        $this->middleware('permission:'.$controller.','.$method)->only([$method]);
    }

}
