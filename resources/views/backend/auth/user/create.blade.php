@inject('model', '\App\Models\User')
@extends('layouts.base')
@section('page_header')
    {{ __('Пользователи') }}
@endsection
@section('slot')

    <x-backend.card>
        <x-slot name="header">
            @lang('Создание пользователя')
        </x-slot>
        <br>

        <x-slot name="body">
            <x-forms.post :action="route('admin.auth.user.store')">

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">@lang('Имя')</label>

                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Имя') }}"
                                       value="{{ old('name') }}" maxlength="100" required/>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">@lang('E-mail')</label>

                            <div class="col-md-10">
                                <input type="email" name="email" class="form-control"
                                       placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" maxlength="255"
                                       required/>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label">@lang('Пароль')</label>

                            <div class="col-md-10">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="{{ __('Пароль') }}" maxlength="100" required
                                       autocomplete="new-password"/>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="password_confirmation"
                                   class="col-md-2 col-form-label">@lang('Повтор пароля')</label>

                            <div class="col-md-10">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control" placeholder="{{ __('Повтор пароля') }}" maxlength="100"
                                       required autocomplete="new-password"/>
                            </div>
                        </div><!--form-group-->
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Создать')</button>
            </x-forms.post>

            <x-utils.view-button :href="route('admin.auth.user.index')" :text="__('Назад')"/>
        </x-slot>
    </x-backend.card>
@endsection
