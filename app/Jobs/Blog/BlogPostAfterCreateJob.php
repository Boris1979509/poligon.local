<?php

namespace App\Jobs\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogPostAfterCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var BlogPost
     */
    private $blogPost;

    /**
     * Create a new job instance.
     *
     * @param BlogPost $blogPost
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        logs()->info(sprintf('Created a new Post %s', $this->blogPost->id));
    }
}
