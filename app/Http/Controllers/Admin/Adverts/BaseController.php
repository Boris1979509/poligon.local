<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        /* Allow access to the administrator, can: -> filter */
        $this->middleware('can: allow-access-admin');
    }
}
