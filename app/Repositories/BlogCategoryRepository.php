<?php

namespace App\Repositories;

use App\Models\Blog\BlogCategory as Model;
use Illuminate\Support\Collection;

class BlogCategoryRepository extends CoreRepository
{

    /**
     * @param $id
     * @return Model
     */
    public function getEdit($id): Model
    {
        return $this->startConditions()->find($id);
    }

    /**
     *  Получить список в выпадающем меню
     * @return Collection
     */
    public function getForComboBox(): Collection
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        $result = $this->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }

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
     * @return mixed
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'title',
            'parent_id',
        ];
        $result = $this->startConditions()
            ->select($columns)
            ->with(['parent:id,title']) // Lazy load
            ->paginate($perPage);
        return $result;
    }
}
