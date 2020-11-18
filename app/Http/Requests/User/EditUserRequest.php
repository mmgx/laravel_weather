<?php

namespace App\Http\Requests\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditUserRequest.
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
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
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
