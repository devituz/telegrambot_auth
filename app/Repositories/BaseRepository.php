<?php

namespace App\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /** @var Builder $model */
    public Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store(Model $model): Model|null
    {
        return $model->save() ? $model : null;
    }

    public function getAllModels(): array|null
    {
        return $this->model->get()->all();
    }

    public function getModelsCount(): int|null
    {
        return $this->model->get()->count();
    }

    public function getModelById($id): Model|null
    {
        return $this->model->where('id', $id)->first();
    }

    public function getModelByIdWithRelations($id, $relations = []): Model|null
    {
        return $this->model->where('id', $id)->with($relations)->first();
    }

    public function getModelByColumnValue($column, $value): Model|null
    {
        return $this->model->where($column, $value)->first();
    }

    public function getModelByColumnsValues(array $columns, array $values): Model|null
    {
        $whereData = [];
        for ($i = 0; $i < count($columns); $i++) {
            $whereData[] = [$columns[$i], '=', $values[$i]];
        }

        /*$sql = $this->model->where($whereData)->toSql();
        logDebug($sql);*/

        return $this->model->where($whereData)->first();
    }
}
