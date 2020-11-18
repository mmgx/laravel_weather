@extends('layouts.base')
@section('page_header')
    {{ __('Города') }}
@endsection
@section('slot')
    @livewire('city-table')
@endsection
