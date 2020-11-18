<?php

namespace App\Repository\Base;

use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @return string
     */
    abstract public function model(): string;

    /**
     * @param Application $app
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \RuntimeException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Создать модель
     * @param array $input
     * @return Model
     */
    public function create($input): Model
    {
        $model = $this->model->newInstance($input);
        $model->save();
        return $model;
    }

    /**
     * Найти модель по ID
     * @param int $id
     * @param array $columns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();
        return $query->find($id, $columns);
    }

    /**
     * Обновить модель по ее ID
     * @param array $input
     * @param int $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->fill($input);
        $model->save();
        return $model;
    }

    /**
     * Удалить модель
     * @param int $id
     * @throws Exception
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        return $model->delete();
    }
}
