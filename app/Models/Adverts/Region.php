<?php

namespace App\Models\Adverts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Region
 * @package App\Models\Adverts
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer|null $parent_id
 *
 * @property Region $parent
 * @property Region[] $children
 */
class Region extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
