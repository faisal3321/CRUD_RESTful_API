<?php

namespace App\Controllers;

class AuthView extends BaseController
{
    // Show Register Page
    // GET /register
    public function register()
    {
        return view('register');
    }

    // Show Login, Update and Delete
    // GET /login
    public function login()
    {
        return view('login');
    }

    // Dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

}