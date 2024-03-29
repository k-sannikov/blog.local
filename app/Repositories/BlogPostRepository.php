<?php
namespace App\Repositories;

use App\Models\BlogPost as Model;

/**
 * Class BlogPostRepository
 *
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список всех статей для вывода
     * (Админка)
     *
     * @param integer|null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAllWithPaginate($perPage = null)
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
            ->orderBy('id', 'desc')
            //активная загрузка отношений
            ->with(['category:id,title', 'user:id,name'])
            ->paginate($perPage);

        return $result;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * @param integer $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
