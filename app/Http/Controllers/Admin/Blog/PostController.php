<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Requests\Admin\Blog\BlogPostUdateRequest;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\View\View;

class PostController extends BaseController
{
    // Paginate
    public const LIMIT = 10;
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;
    /**
     * @var BlogCategory
     */
    private $blogCategoryRepository;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * @return Factory|View
     */
    public function index(): View
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(self::LIMIT);
        return view('admin.blog.posts.index', compact('paginator'));
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): void
    {
        //
    }

    /**
     * @param BlogPost $post
     * @return Factory|View
     */
    public function edit(BlogPost $post): View
    {
        $item = $this->blogPostRepository->getEdit($post->id);
        if ($item === null) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('admin.blog.posts.edit', compact('item', 'categoryList'));
    }


    public function update(BlogPostUdateRequest $request, $id)
    {
        if ($item = $this->blogPostRepository->getEdit($id)) {
            return back()->with('error', $id . ' ' . __('Not found'))->withInput();
        }

        if ($item->update($request->all())) {
            return redirect()
                ->route('admin.blog.posts.edit', $id)
                ->with('success', __('Saved successfully'));
        }
    }

    public function destroy($id): void
    {
        //
    }
}
