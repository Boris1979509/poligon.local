<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Requests\Admin\Blog\BlogCategoryCreateRequest;
use App\Http\Requests\Admin\Blog\BlogCategoryUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Models\Blog\BlogCategory;
use Illuminate\View\View;

class CategoryController extends BaseController
{
    // Paginate
    public const LIMIT = 5;
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(self::LIMIT);
        return view('admin.blog.categories.index', compact('paginator'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('admin.blog.categories.create', compact('item', 'categoryList'));
    }

    /**
     * @param BlogCategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request): ?RedirectResponse
    {
        if ($category = app(BlogCategory::class)->create($request->all())) {
            return redirect()
                ->route('admin.blog.categories.edit', $category->id)
                ->with('success', __('Saved successfully'));
        }
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if ($item === null) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('admin.blog.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * @param BlogCategoryUpdateRequest $request
     * @param $id
     * @return RedirectResponse|null
     */
    public function update(BlogCategoryUpdateRequest $request, $id): ?RedirectResponse
    {
        $category = $this->blogCategoryRepository->getEdit($id);
        if (!$category) {
            return back()->with('error', $id . ' ' . __('Not found'))->withInput();
        }

        // $data = $request->all(); // Array
        // $category->fill($data)->save(); // return bool

        if ($category->update($request->all())) {
            return redirect()
                ->route('admin.blog.categories.edit', $id)
                ->with('success', __('Saved successfully'));
        }

    }

    /**
     * @param $id
     */
    public function destroy($id): void
    {
        //
    }

}
