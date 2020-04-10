<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Models\Blog\BlogPost;
use Illuminate\Http\Response;

class PostController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $item = BlogPost::all();
        return view('blog.posts.index', compact('item'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
