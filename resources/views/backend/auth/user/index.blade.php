@extends('layouts.base')
@section('page_header')
    {{ __('Список пользователей') }}
@endsection
@section('slot')
    @livewire('users-table')
@endsection
