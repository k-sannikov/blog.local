<?php
namespace App\Repositories;

use App\Models\BlogCategory as Model;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить категорию для вывода пагинатором
     *
     * @param integer|null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];
        $result = $this
            ->startConditions()
            //активная загрузка отношений
            ->with(['parentCategory:id,title'])
            ->paginate($perPage, $columns);

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

    /**
     * Получить список категорий для вывода в выпадающем списке
     *
     * @return Collection
     */
    public function getForSelect()
    {
        // $columns = implode(', ', [
        //     'id',
        //     'CONCAT (id, ". ", title) AS id_title',
        // ]);

        // $result = $this
        //     ->startConditions()
        //     ->selectRaw($columns)
        //     ->toBase()
        //     ->get();

        $result = $this->startConditions()
            ->select(['id', 'title'])
            ->toBase()
            ->get();

        return $result;
    }
}
