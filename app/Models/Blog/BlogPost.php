<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogPost
 * @property $id id
 */
class BlogPost extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
}
