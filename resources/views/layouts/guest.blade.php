@extends('layouts.layout')

@section('head_styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('head_scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
@endsection

@section('body')
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
@stop
