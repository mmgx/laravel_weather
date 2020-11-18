<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\API\Base\BaseController;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class UserController.
 */
class UserController extends BaseController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('backend.auth.user.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.user.create');
    }

    /**
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return redirect()->route('admin.auth.user.show', $user)->withFlashSuccess(__('The user was successfully created.'));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function show(User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param  EditUserRequest  $request
     * @param  User  $user
     *
     * @return mixed
     */
    public function edit(EditUserRequest $request, User $user)
    {
        return view('backend.auth.user.edit')
            ->withUser($user);
    }

    /**
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());
        return redirect()->route('admin.auth.user.index', $user)->withFlashSuccess(__('Пользователь успешно обновлен'));
    }


    public function delete(DeleteUserRequest $request, User $user)
    {
        $this->userService->delete($user);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('Пользователь успешно удален.'));
    }

    public function destroy(DeleteUserRequest $request, User $user)
    {
        if ($this->userService->destroy($user)){
            return redirect(route('admin.auth.user.index'))->withFlashSuccess(__('Пользователь успешно уничтожен'));
        };

    }

    public function restore(User $user)
    {
        if ($user->restore()) {
            return redirect(route('admin.auth.user.index'))->withFlashSuccess(__('Пользователь успешно восстановлен'));
        }

        throw new \RuntimeException(__('Возникла проблема при восстановлении пользователя'));
    }
}
