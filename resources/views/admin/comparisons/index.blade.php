@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Artículos de comparación</h1>
@stop

@section('content')
    @livewire('items-comparisons-component')
@stop

@section('css')
    @include('admin.partials.css')
@stop

@section('js')
    @include('admin.partials.scripts')
@stop