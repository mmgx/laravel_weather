<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Пользователи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-backend.card>
                        <x-slot name="header">
                            @lang('Информация о пользователе')  {{ $user->name }}
                        </x-slot>

                        <x-slot name="headerActions">
                            <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Назад')" />
                        </x-slot>

                        <x-slot name="body">
                            <table class="table table-hover">
                                <tr>
                                    <th>@lang('Имя')</th>
                                    <td>{{ $user->name }}</td>
                                </tr>

                                <tr>
                                    <th>@lang('E-mail Address')</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Аккаунт создан')</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Аккаунт обновлен')</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            </table>
                        </x-slot>
                    </x-backend.card>
            </div>
        </div>
    </div>
</x-app-layout>
