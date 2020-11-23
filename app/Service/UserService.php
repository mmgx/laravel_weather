<?php

namespace App\Service;

use App\Exceptions\GeneralException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService extends Base\BaseService
{
    /**
     * UserService constructor.
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param User $user
     * @return User
     * @throws GeneralException
     */
    public function restore(User $user): User
    {
        if ($user->restore()) {
            return $user;
        }

        throw new GeneralException(__('Возникла проблема при восстановлении пользователя'));
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data = []): User
    {
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('Возникла проблема при обновлении пользователя'));
        }

        DB::commit();
        return $user;
    }

    public function delete(User $user): User
    {
        if ($user->id === auth()->id()) {
            throw new GeneralException(__('You can not delete yourself.'));
        }

        if ($this->deleteById($user->id)) {
            return $user;
        }

        throw new GeneralException('Возникла ошибка при удалении пользователя');
    }

    public function destroy(User $user): bool
    {
        if ($user->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('Возникла проблема при перманентном удалении пользователя'));
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data = []): User
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Возникла проблема при создании пользователя.'));
        }

        DB::commit();

        return $user;
    }

    /**
     * @param array $data
     * @return User
     */
    protected function createUser(array $data = []): User
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
            'email_verified_at' => $data['email_verified_at'] ?? null,
        ]);
    }

}
