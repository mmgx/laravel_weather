@extends('layouts.base')
@section('page_header')
    {{ __('История изменения погоды в городе ') }} {{ $city->name }}
@endsection
@section('slot')
    @livewire('current-city-table', ['city' => $city])
@endsection
