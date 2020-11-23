@extends('layouts.layout')
@section('head_styles')
    @include('includes.assets.css')
@stop

@section('head_scripts')
    @include('includes.assets.js')
@stop

@yield('head_scripts')
@section('body')
    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-dropdown')

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
@stop
