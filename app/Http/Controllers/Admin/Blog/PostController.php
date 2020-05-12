<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Requests\Admin\Blog\BlogPostUdateRequest;
use App\Http\Requests\Admin\Blog\BlogPostCreateRequest;
use App\Jobs\Blog\BlogPostAfterCreateJob;
use App\Jobs\Blog\BlogPostAfterDeleteJob;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Facades\Auth;
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

    /**
     * @return Factory|View
     */
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('admin.blog.posts.create', compact('item', 'categoryList'));
    }

    /**
     * @param BlogPostCreateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogPostCreateRequest $request): ?RedirectResponse
    {
        $request->user_id = Auth::user()->id;
        if ($post = (new BlogPost())->create($request->input())) {
            // Create Queue
            $job = new BlogPostAfterCreateJob($post);
            $this->dispatch($job);
            return redirect()
                ->route('admin.blog.posts.edit', $post->id)
                ->with('success', __('Saved successfully'));
        }
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

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // $item = BlogPost::find($id)->forceDelete();

        // Soft deleted
        if ($item = BlogPost::destroy($id)) {
            BlogPostAfterDeleteJob::dispatch($id)->delay(20);
            return redirect()
                ->route('admin.blog.posts.index')
                ->with('success', __('Deleted successfully'));
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $post = $this->blogPostRepository->getRestore($id);
        if ($post->restore()) {
            return redirect()
                ->route('admin.blog.posts.index')
                ->with('success', __('Restored successfully'));
        }
    }
}
