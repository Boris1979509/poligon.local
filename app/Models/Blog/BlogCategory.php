<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @property $id id
 * @property $slug slug
 * @property $title title
 * @property $parent_id parent_id
 * @property $description description
 */
class BlogCategory extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'parent_id',
        'description',
    ];

}
