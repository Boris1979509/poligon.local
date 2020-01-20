<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class TestController extends Controller {

    public function index() {
        $flights = BlogCategory::all();
//        dd(BlogCategory::where('parent_id', 1)->orderBy('title', 'desc')
//               ->limit(3)
//               ->get());
        $blog = new BlogCategory();
        $title = "Категория №14";
        $data = [
            'parent_id' => 2,
            'slug' => Str::slug($title, "_"),            
            'title' => $title,

        ];
        $blog->fill($data)->save();
    }

}
