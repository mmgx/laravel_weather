@extends('layouts.base')
@section('page_header')
    {{ __('Пользователи') }}
@endsection
@section('slot')

    <x-backend.card>
        <x-slot name="header">
            @lang('Редактирование пользователя') <b>{{ Str::ucfirst($user->name) }}</b>
        </x-slot>
        <br>

        <x-slot name="body">
            <x-forms.patch :action="route('admin.auth.user.update', $user)">

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Имя') }}"
                               value="{{ old('name') ?? $user->name }}" maxlength="100" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label">@lang('E-mail')</label>

                    <div class="col-md-10">
                        <input type="email" name="email" id="email" class="form-control"
                               placeholder="{{ __('E-mail') }}" value="{{ old('email') ?? $user->email }}"
                               maxlength="255" required/>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Обновить')</button>
            </x-forms.patch>

            <x-utils.view-button :href="route('admin.auth.user.index')" :text="__('Назад')"/>
        </x-slot>
    </x-backend.card>
@endsection
