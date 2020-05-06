<?php

namespace App\Observers;

use App\Models\Blog\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

// Can register boot app/Providers/AppServiceProvider.php
class BlogPostObserver
{
    /**
     * @param BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setUser($blogPost);
        $this->setHtml($blogPost);
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost): void
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     */
    public function deleting(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost): void
    {
        $blogPost->published_at = ($blogPost->is_published) ? Carbon::now() : null;
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost): void
    {
        // If field title was changed or title is empty
        if (empty($blogPost->slug) || $blogPost->isDirty('title')) {
            $blogPost->slug = Str::slug($blogPost->title, '_');
        }
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setUser(BlogPost $blogPost): void
    {
        if (Auth::user()) {
            $blogPost->user_id = Auth::user()->id;
        }
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setHtml(BlogPost $blogPost): void
    {
        if ($blogPost->isDirty('content_raw')) {
            $blogPost->content_html = $blogPost->content_raw;
        }
    }
}
