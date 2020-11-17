<?php

namespace App\Http\Requests\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditUserRequest
 * @package App\Http\Requests\User
 */
class EditUserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return ! ($this->user->isAdmin() && ! $this->user()->isAdmin());
    }

    /**
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Только администратор может обновить этого пользователя.'));
    }
}
