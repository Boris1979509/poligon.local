<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $parent_id
 * @property string $description
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
