@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('users-component')
@stop

@section('css')
    @include('admin.partials.css')
@stop

@section('js')
    @include('admin.partials.scripts')
@stop