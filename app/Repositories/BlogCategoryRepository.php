<?php
namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

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
            ->paginate($perPage, $columns);

        return $result;
    }
}
