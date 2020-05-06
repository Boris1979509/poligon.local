<?php

namespace App\Repositories;

use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPost as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Integer;

class BlogPostRepository extends CoreRepository
{
    /**
     * Возвращает полное имя класса
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null): LengthAwarePaginator
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'deleted_at',
            'user_id',
            'category_id',
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['category:title,id', 'user:id,name']) // Lazy load
            ->withTrashed()
            ->paginate($perPage);
        return $result;
    }

    /**
     * @param $id
     * @return Model
     */
    public function getEdit($id): Model
    {
        return $this->startConditions()->find($id);
    }

    /**
     * @param $id
     * @return Builder
     */
    public function getRestore($id): Builder
    {
        return $this->startConditions()->where('id', $id);
    }
}
