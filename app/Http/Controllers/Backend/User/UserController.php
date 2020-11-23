<?php

namespace App\Http\Controllers\Backend\User;

use App\Exceptions\GeneralException;
use App\Http\Controllers\API\Base\BaseController;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\RestoreUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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
        $request->session()->flash('toast_success', __('Успешно создан пользователь ' . $user->email));
        return redirect()->route('admin.user.index', $user);
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
        $request->session()->flash('toast_success', __('Успешно обновлен пользователь ' . $user->email));
        return redirect()->route('admin.user.index', $user);
    }


    public function delete(DeleteUserRequest $request, User $user)
    {
        $this->userService->delete($user);
        $request->session()->flash('toast_success', __('Успешно удален пользователь ' . $user->email));
        return redirect()->route('admin.user.index');
    }

    public function destroy(DeleteUserRequest $request, User $user)
    {
        if ($this->userService->destroy($user)){
            $request->session()->flash('toast_success', __('Успешно уничтожен пользователь ' . $user->email));
            return redirect(route('admin.user.index'));
        };

    }

    /**
     * @param RestoreUserRequest $request
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     * @throws GeneralException
     */
    public function restore(RestoreUserRequest $request, User $user)
    {
        if ($user->restore()) {
            $request->session()->flash('toast_success', __('Успешно восстановлен пользователь ' . $user->email));
            return redirect(route('admin.user.index'));
        }

        throw new GeneralException(__('Возникла проблема при восстановлении пользователя'));
    }


}
