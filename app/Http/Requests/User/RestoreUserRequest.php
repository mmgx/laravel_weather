<?php

namespace App\Http\Requests\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RestoreUserRequest
 * @package App\Http\Requests\User
 */
class RestoreUserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
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
     * @throws AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Ошибка при восстановлении пользователя'));
    }
}
