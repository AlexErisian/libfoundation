<?php

namespace App\Repositories;

use App\Models\Bookshelf as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BookshelfRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $nbPerPage
     * @param bool $withTrashed
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination($nbPerPage = 15, $withTrashed = false)
    {
        $columns = ['id', 'library_id', 'printing_id',
            'exemplars_registered', 'exemplars_in_stock',];
        $relations = [
            'library:id,name',
            'library' => function ($query) use ($withTrashed) {
                return $query->withTrashed();
            },
            'printing:id,title',
            'printing' => function ($query) use ($withTrashed) {
                return $query->withTrashed();
            },
        ];

        return $this->startConditions()
            ->select($columns)
            ->with($relations)
            ->withTrashed($withTrashed)
            ->paginate($nbPerPage);
    }

    public function getAllByLibraryId($libraryId, $nbPerPage = 15)
    {
        $columns = ['id', 'library_id', 'printing_id',
            'exemplars_registered', 'exemplars_in_stock',
            'shelf_number', 'shelf_floor'];
        $relations = ['printing:id,title'];

        return $this->startConditions()
            ->select($columns)
            ->where('library_id', $libraryId)
            ->with($relations)
            ->orderBy('shelf_number', 'asc')
            ->paginate($nbPerPage);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
