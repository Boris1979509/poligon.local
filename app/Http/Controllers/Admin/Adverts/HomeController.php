<?php

namespace App\Http\Controllers\Admin\Adverts;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index()
    {
        return view('admin.adverts.home');
    }
}
