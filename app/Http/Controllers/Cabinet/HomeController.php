<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        /* Вход только для зарегистрированных пользователей */
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cabinet.home');
    }
}
