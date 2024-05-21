<?php

namespace App\Http\Helpers;

use Illuminate\Database\Eloquent\Model;

class SearchHelper
{
    /**
     *
     * @param string $modelClass
     * @param array $columns
     * @param string $searchTerm
     * @param array $sortOptions
     * @param int $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function search(
        string $modelClass,
        array $columns,
        string $searchTerm,
        array $sortOptions = [],
        int $paginate = 20
    )
    {
        if (!class_exists($modelClass) || !is_subclass_of($modelClass, Model::class)) {
            throw new \InvalidArgumentException("The provided model class does not exist or is not a valid Eloquent model.");
        }

        $query = $modelClass::query();

        if (count($columns) > 0) {
            $query->where(function ($subQuery) use ($columns, $searchTerm) {
                foreach ($columns as $column) {
                    $subQuery->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            });
        }

        foreach ($sortOptions as $column => $order) {
            $query->orderBy($column, $order);
        }

        return $query->paginate($paginate);
    }
}
