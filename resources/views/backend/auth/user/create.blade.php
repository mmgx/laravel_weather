@inject('model', '\App\Models\User')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Пользователи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <x-forms.post :action="route('admin.auth.user.store')">
                    <x-backend.card>
                        <x-slot name="header">
                            @lang('Создание пользователя')
                        </x-slot>

                        <x-slot name="headerActions">
                            <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Cancel')" />
                        </x-slot>
                        <x-slot name="body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label">@lang('Имя')</label>

                                    <div class="col-md-10">
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('Имя') }}" value="{{ old('name') }}" maxlength="100" required />
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label">@lang('E-mail')</label>

                                    <div class="col-md-10">
                                        <input type="email" name="email" class="form-control" placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" maxlength="255" required />
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label">@lang('Пароль')</label>

                                    <div class="col-md-10">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Пароль') }}" maxlength="100" required autocomplete="new-password" />
                                    </div>
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-md-2 col-form-label">@lang('Повтор пароля')</label>

                                    <div class="col-md-10">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Повтор пароля') }}" maxlength="100" required autocomplete="new-password" />
                                    </div>
                                </div><!--form-group-->
                        </x-slot>

                        <x-slot name="footer">
                            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Создать пользователя')</button>
                        </x-slot>
                    </x-backend.card>
                </x-forms.post>
            </div>
        </div>
    </div>
</x-app-layout>
