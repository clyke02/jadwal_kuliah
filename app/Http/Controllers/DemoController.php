<?php

namespace App\Http\Controllers;

class DemoController extends Controller
{
    public function login()
    {
        return view('demo.login');
    }

    public function register()
    {
        return view('demo.register');
    }
}
