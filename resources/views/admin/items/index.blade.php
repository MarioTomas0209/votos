@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Artículos</h1>
@stop

@section('content')
    @livewire('items-component')
@stop

@section('css')
    @include('admin.partials.css')
@stop

@section('js')
    @include('admin.partials.scripts')
@stop