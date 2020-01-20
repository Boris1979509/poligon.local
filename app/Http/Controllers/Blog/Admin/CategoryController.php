<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdate;

class CategoryController extends BaseController {

    const LIMIT = 5;

    public function index() {
        $paginator = BlogCategory::paginate(self::LIMIT);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //$item = BlogCategory::findOrFail($id); // найти или неудачу 404
        //$item = BlogCategory::find($id); // найти или null
        $item = BlogCategory::where('id', $id)->first(); // select * from `blog_categories` where `id` = '4' limit 1
        $categoryList = BlogCategory::all();
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdate $request, $id) {

        //$validatedData = $this->validate($rules);        
        $validatedData = $request->validate();
//
        dd($validatedData);
        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back()->withErrors(['msg' => "Запись с ID-$id не найдена."])->withInput();
        }
        $data = $request->all();
        $result = $item->fill($data)->save();
        if ($result) {
            return redirect()
                            ->route('blog.admin.categories.edit', $item->id)
                            ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения."])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
