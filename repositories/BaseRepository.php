<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    /**
     * The model associated with the repository.
     *
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records.
     *
     * @return Collection
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Find records based on the given conditions.
     *
     * @param array $conditions
     * @return Collection
     */
    public function getWhere(array $conditions)
    {
        return $this->model->where($conditions)->get();
    }

    /**
     * Find records based on the given conditions.
     *
     * @param array $conditions
     * @return Model|null
     */
    public function findByAttributes(array $conditions)
    {
        return $this->model->where($conditions)->first();
    }

    /**
     * Get paginated records.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginated(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Create a record.
     *
     * @param array $values
     * @return Model
     */
    public function create(array $values)
    {
        return $this->model->create($values);
    }

    /**
     * Create or update a record.
     *
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function createOrUpdate(array $attributes, array $values)
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * Delete a record by its primary key.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Delete records based on the given conditions.
     *
     * @param array $conditions
     * @return bool|null
     */
    public function deleteWhere(array $conditions)
    {
        return $this->model->where($conditions)->delete();
    }
}
