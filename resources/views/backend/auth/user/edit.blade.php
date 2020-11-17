<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Пользователи') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <x-forms.patch :action="route('admin.auth.user.update', $user)">

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                                   value="{{ old('name') ?? $user->name }}" maxlength="100" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $user->email }}"
                                   maxlength="255" required/>
                        </div>
                    </div>


                    <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Обновить')</button>
                </x-forms.patch>
            </div>
        </div>
    </div>
</x-app-layout>
