@if ($user->trashed() && $logged_in_user->isAdmin())
    <x-utils.form-button
        :action="route('admin.auth.user.restore', $user)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>
    <x-utils.delete-button
        :href="route('admin.auth.user.destroy', $user)"
        :text="__('Уничтожить')"/>
@else
    @if ($logged_in_user->isAdmin())
        <x-utils.view-button :href="route('admin.auth.user.show', $user)"/>
        <x-utils.edit-button :href="route('admin.auth.user.edit', $user)"/>
    @endif


    @if ($user->id !== $logged_in_user->id && !$user->isAdmin())
        <x-utils.delete-button :href="route('admin.auth.user.delete', $user)" :text="__('Удалить')"/>
    @endif

@endif
