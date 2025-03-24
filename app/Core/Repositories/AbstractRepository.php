<?php

namespace App\Core\Repositories;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Core\Contracts\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(
        array $columns = ['*'],
        array $relations = [],
        array $conditions = [],
        ?int $perPage = null,
        array $orderBy = [],
        array $scopes = []
    ) {
        $query = $this->model->select($columns);

        foreach ($conditions as $column => $value) {
            $query->where($column, $value);
        }

        if (!empty($relations) && $this->model->exists()) {
            $query->with($relations);
        }

        if (!empty($scopes)) {
            foreach ($scopes as $scope => $parameters) {
                if (is_string($scope)) {
                    if (is_array($parameters)) {
                        $query->{$scope}(...$parameters);
                    } else {
                        $query->{$scope}($parameters);
                    }
                } elseif (is_numeric($scope) && is_string($parameters)) {
                    $query->{$parameters}();
                }
            }
        }

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $perPage ? $query->paginate($perPage) : $query->get();
    }


    public function getById(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->model->select($columns)
            ->when(!empty($relations) && $this->model->exists(), function ($query) use ($relations) {
                $query->with($relations);
            })
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        try {
            $record = $this->model->create($data);

            // Handle media upload, using hasMedia trait
            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $record->addMedia($data['image'], $this->model->getTable());
            }

            // Handle multiple medias upload, using hasMedia trait
            if (isset($data['images']) && is_array($data['images'])) {
                foreach ($data['images'] as $image) {
                    $record->addMedia($image, $this->model->getTable());
                }
            }

            return $record;
        } catch (Exception $e) {
            Log::error("Error storing record: " . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $record = $this->getById($id);
            $record->update($data);

            $newMediaRecords = [];
            if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
                $newMediaRecords = $record->updateMedia($data['image'], $this->model->getTable());
            }

            // Handle multiple media uploads
            if (isset($data['images']) && is_array($data['images'])) {
                $newMediaRecords = $record->updateMedia($data['images'], $this->model->getTable());
            }

            // Remove old media after uploading new ones
            if (!empty($newMediaRecords)) {
                $record->removeOldMedia($newMediaRecords);
            }

            return $record;
        } catch (Exception $e) {
            Log::error("Error updating record: " . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $record = $this->getById($id);
            $record->delete();
            $record->clearMedia();
            return true;
        } catch (Exception $e) {
            Log::error("Error deleting record: " . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
