<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

abstract class BaseController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @param $name
     * @return string
     */
    public function slug($name): string
    {
        return Str::slug($name, '_');
    }
}

