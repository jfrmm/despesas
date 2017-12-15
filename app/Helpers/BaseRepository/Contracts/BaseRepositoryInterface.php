<?php

namespace App\Helpers\BaseRepository\Contracts;

/**
 * The base repository interface
 */
interface BaseRepositoryInterface
{
    public function all($filter, $columns = ['*'], $eagerLoad = []);

    public function create($request);

    public function find($request, $id, $columns = ['*'], $eagerLoad = [], $withTrashed = false);

    public function findByField($request, $field);

    public function update($request, $id, $columns = ['*'], $eagerLoad = []);

    public function delete($request, $id, $hardDelete = false);

    public function attach($request, $id);

    public function detach($request, $id);
}
