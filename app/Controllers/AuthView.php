<?php

namespace App\Controllers;

class AuthView extends BaseController
{
    // Show Register Page
    // GET /register
    public function register()
    {
        return view('auth/register');
    }

    // Show Login Page
    // GET /login
    public function login()
    {
        return view('auth/login');
    }
}