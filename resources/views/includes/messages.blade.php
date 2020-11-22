@if(isset($errors) && $errors->any())
    <x-utils.alert type="danger" class="header-message">
        @foreach($errors->all() as $error)
            {{ $error }}<br/>
        @endforeach
    </x-utils.alert>
@endif

@if(Session::has('flash_success'))
    <x-utils.alert type="success" class="header-message">
        {{ session()->get('flash_success') }}
    </x-utils.alert>
@endif

@if(Session::has('flash_warning'))
    <x-utils.alert type="warning" class="header-message">
        {{ session()->get('flash_warning') }}
    </x-utils.alert>
@endif

@if(Session::has('flash_info') || Session::has('flash_message'))
    <x-utils.alert type="info" class="header-message">
        {{ Session::get('flash_info') }}
    </x-utils.alert>
@endif

@if(Session::has('flash_danger'))
    <x-utils.alert type="danger" class="header-message">
        {{ session()->get('flash_danger') }}
    </x-utils.alert>
@endif

@if(Session::has('status'))
    <x-utils.alert type="success" class="header-message">
        {{ session()->get('status') }}
    </x-utils.alert>
@endif

@if(Session::has('toast_success'))
    @include('includes.script.toast_success')
@endif

@if(Session::has('weather'))
    @include('includes.script.weather')
@endif
