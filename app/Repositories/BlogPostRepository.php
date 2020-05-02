<?php

namespace App\Repositories;

use App\Models\Blog\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

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
            'user_id',
            'category_id',
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['category:title,id', 'user:id,name']) // Lazy load
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
}
