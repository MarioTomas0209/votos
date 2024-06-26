@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Votos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Usuarios que ya han votado</h3>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="text-center table table-bordered border-primary">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nombre</th>
                                <th>Item</th>
                                <th><i class="fas fa-image"></i></th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($votes as $vote)
                                <tr>
                                    <td>{{ $vote->id }}</td>
                                    <td>{{ $vote->user->name }}</td>
                                    <td>{{ $vote->item->name }}</td>
                                    <td>
                                        @if($vote->item && $vote->item->image_url)
                                            <img src="{{ asset('storage/' . $vote->item->image_url) }}" alt="{{ $vote->item->name }}" style="width: 4rem;">
                                        @else
                                            <img src="{{ asset('no-image.png') }}" alt="No image available" style="width: 4rem;">
                                        @endif
                                    </td>
                                    <td>{{ $vote->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $votes->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Usuarios que no han votado</h3>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="text-center table table-bordered border-primary">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usersWhoDidNotVote as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    {{ $usersWhoDidNotVote->links('pagination::bootstrap-4') }} 
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header bg-success">
            <h3 class="card-title">Items ganadores</h3>
        </div>

        <div class="card-body p-0 table-responsive">
            <table class="text-center table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th><i class="fas fa-image"></i></th>
                        <th>Porcentaje de Votos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comparisons as $comparison)
                            @php
                                $winnerItem = $comparison->votes_item1 >= $comparison->votes_item2 ? $comparison->item1 : $comparison->item2;
                                $winnerVotes = $comparison->votes_item1 >= $comparison->votes_item2 ? $comparison->votes_item1 : $comparison->votes_item2;
                                $winnerColor = $comparison->votes_item1 >= $comparison->votes_item2 ? 'text-success' : 'text-danger';
                            @endphp
                            <tr>
                                <td>{{ $winnerItem->name }}</td>
                                <td>
                                    @if($winnerItem->image_url)
                                        <img src="{{ asset('storage/' . $winnerItem->image_url) }}" alt="{{ $winnerItem->name }}" style="width: 4rem;">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" alt="No image available" style="width: 4rem;">
                                    @endif
                                </td>
                                <td class="{{ $winnerColor }}">{{ $winnerVotes }}%</td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>


@stop

@section('css')
@include('admin.partials.css')
@stop

@section('js')
@include('admin.partials.scripts')
@stop