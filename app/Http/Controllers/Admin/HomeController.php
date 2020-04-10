<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        return view('admin.home');
    }
}
