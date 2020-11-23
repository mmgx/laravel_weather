@extends('layouts.base')
@section('page_header')
    {{ __('Редактирование пользователя') }} {{ Str::ucfirst($user->name) }}
@endsection
@section('slot')

    <x-backend.card>
        <x-slot name="header">
            @lang('Информация о пользователе') <b>{{ Str::ucfirst($user->name) }}</b>
        </x-slot>
        <br>

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
            <x-utils.view-button :href="route('admin.user.index')" :text="__('Назад')"/>
        </x-slot>
    </x-backend.card>
@endsection
