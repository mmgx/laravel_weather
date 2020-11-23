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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    @yield('page_header')
                </h2>
            </div>
        </header>

        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        @include('includes.messages')
                        @yield('slot')
                    </div>
                </div>
            </div>
        </main>
    </div>
    @stack('modals')
@stop

@section('bottom_scripts')
    @livewireScripts
@stop
