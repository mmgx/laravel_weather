<?php

namespace App\Http\Livewire;

use App\Http\Controllers\API\UserController;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class UsersTable.
 */
class UsersTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';
    public $offlineIndicator = false;
    public $loadingIndicator = false;
    public $searchEnabled = false;

    /**
     * @return Builder
     * @var string
     */
    public function query(): Builder
    {
        return User::query()->orderBy('id', 'asc')->withTrashed();
    }

    public function view(): string
    {
        return 'livewire.admin.users.index';
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Id'), 'id')
                ->sortable(),
            Column::make(__('Имя пользователя'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('E-mail'), 'email')
                ->searchable()
                ->sortable()
                ->format(function (User $model) {
                    return $this->mailto($model->email);
                }),
            Column::make(__('Действия'))
                ->format(function (User $model) {
                    return view('backend.auth.user.includes.actions', ['user' => $model]);
                }),
        ];
    }
}
