<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    public function __construct()
    {
        /* Allow access to the administrator, can: -> filter */
        $this->middleware('can:allow-access-admin');
    }
}

