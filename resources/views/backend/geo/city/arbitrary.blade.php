@extends('layouts.base')
@section('page_header')
    {{ __('Запрос погоды онлайн в произвольном городе с сайта openweathermap.org') }}
@endsection
@section('slot')

    <x-backend.card>
        <x-slot name="header">
            @lang('Введите любой город')
        </x-slot>
        <br>

        <x-slot name="body">
            <x-forms.get :action="route('admin.geo.cities.arbitrary', '')">

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Название города')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Название города') }}"
                               value="{{ old('name') }}" maxlength="100" required/>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Запросить')</button>
            </x-forms.get>

            <x-utils.view-button :href="route('dashboard')" :text="__('На главную')"/>
        </x-slot>
    </x-backend.card>
@endsection
