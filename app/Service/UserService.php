<?php

namespace App\Service;

use App\Models\User as Model;

class UserService extends Base\BaseService
{
    /**
     * UserService constructor.
     * @param  Model  $user
     */
    public function __construct(Model $user)
    {
        $this->model = $user;
    }
}
