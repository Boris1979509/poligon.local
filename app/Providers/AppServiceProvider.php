<?php

namespace App\Providers;

use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;
use App\Observers\BlogCategoryObserver;
use App\Observers\BlogPostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
    }
}
