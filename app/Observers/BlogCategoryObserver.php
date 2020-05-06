<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    /**
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function creating(BlogCategory $blogCategory): void
    {
        $this->setSlug($blogCategory);
    }

    /**
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function updating(BlogCategory $blogCategory): void
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * @param BlogCategory $blogCategory
     */
    protected function setSlug(BlogCategory $blogCategory): void
    {
        // If field title was changed or title is empty
        if (empty($blogCategory->slug) || $blogCategory->isDirty('title')) {
            $blogCategory->slug = Str::slug($blogCategory->title, '_');
        }
    }
}
