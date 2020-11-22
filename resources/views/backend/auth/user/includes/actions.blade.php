@if ($user->trashed() && ((auth()->user()->id) === 1))

    <x-utils.form-button
        :action="route('admin.user.restore', $user)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Восстановить')
    </x-utils.form-button>
    <x-utils.delete-button
        :href="route('admin.user.destroy', $user)"
        :text="__('Уничтожить')"/>
@else

    <x-utils.view-button :href="route('admin.user.show', $user)" :text="__('Просмотреть')"/>
    @if ((!$user->isAdmin()) || ($user->id === auth()->id()))
        <x-utils.edit-button :href="route('admin.user.edit', $user)" :text="__('Редактировать')"/>
    @endif

    @if ($user->id !== $logged_in_user->id && !$user->isAdmin() && ($logged_in_user->id === 1))
        <x-utils.delete-button :href="route('admin.user.delete', $user)" :text="__('Удалить')"/>
    @endif

@endif
