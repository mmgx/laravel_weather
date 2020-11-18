<?php

namespace App\Repository;

use App\Models\User as Model;

class UserRepository extends Base\BaseRepository
{
    /**
     * Получить название класса
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function __construct(Model $user)
    {
        $this->model = $user;
    }


    public function model(): string
    {
        return $this->getModelClass();
    }
}
