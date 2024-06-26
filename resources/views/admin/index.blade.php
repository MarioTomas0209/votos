@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $itemsTotal }}</h3>
                <p>Artículos</p>
            </div>
            <div class="icon">
                <i class="fas fa-cookie-bite"></i>
            </div>
            <a href="{{ url('items') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{  $comparisonTotal }}</h3>
                <p>Comparaciones</p>
            </div>
            <div class="icon">
                <i class="fas fa-assistive-listening-systems"></i>
            </div>
            <a href="{{ url('comparison') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-12">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $votersTotal }}</h3>
                <p>Votos</p>
            </div>
            <div class="icon">
                <i class="fas fa-poll"></i>
            </div>
            <a href="{{ url('votes') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!"); 
</script>
@stop