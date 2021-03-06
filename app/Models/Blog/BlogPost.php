<?php

namespace App\Models\Blog;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Mixed_;

/**
 * Class BlogPost
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content_raw
 * @property string $content_html
 * @property bool $is_published
 * @property string $published_at
 * @property User $user_id
 * @property BlogCategory $category_id
 */
class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'slug',
        'content_raw',
        'is_published',
        'deleted_at',
        'published_at',
        'excerpt',
    ];

    /**
     * Объект класса BlogCategory текущего поста
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    /**
     * Объект класса User текущего поста
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getPublishedAtAttribute($value): ?string
    {
        if (!$value) {
            return null;
        }
        return Carbon::parse($value)->format('d.M H.i');
    }
}
