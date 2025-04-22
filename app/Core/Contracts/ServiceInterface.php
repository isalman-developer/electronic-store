<?php

namespace App\Core\Contracts;

interface ServiceInterface
{
    public function getAll(
        array $columns = ['*'],
        array $relations = [],
        array $conditions = [],
        ?int $perPage = null,
        array $orderBy = [],
        array $scopes = []
    );

    public function getById(
        int $id,
        array $columns = ['*'],
        array $relations = []
    );

    public function getBySlug(
        string $slug,
        array $columns = ['*'],
        array $relations = []
    );

    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
