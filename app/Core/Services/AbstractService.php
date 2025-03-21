<?php

namespace App\Core\Services;

use App\Core\Contracts\ServiceInterface;
use Illuminate\Support\Facades\DB;

abstract class AbstractService implements ServiceInterface
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAll(
        array $columns = ['*'],
        array $relations = [],
        array $conditions = [],
        ?int $perPage = null,
        array $orderBy = [],
        array $scopes = []
    ) {
        return $this->repository->getAll($columns, $relations, $conditions, $perPage, $orderBy, $scopes);
    }

    public function getById(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->repository->getById($id, $columns, $relations);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->repository->store($data);
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            return $this->repository->update($id, $data);
        });
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->repository->delete($id);
        });
    }
}
