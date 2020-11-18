<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Base\BaseController;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\isEmpty;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return $this->sendResponse($users->toArray(), __('Список пользователей получен'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show($user)
    {
        $users = User::query()->where('name', $user)->get();
        if (collect($users)->isEmpty()){
            return $this->sendError('Пользователь не найден');
        }
        return $this->sendResponse($users->toArray(), __('Пользователь получен'));
    }
}
