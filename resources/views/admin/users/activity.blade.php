@extends('layouts.admin')
@section('title')
    AdminPanel - User activity
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
@if(count($activity) == 0)
    <div class="jumbotron">
        <div class="container text-center">
            <p class="lead">Korisnik nema aktivnosti za prikaz</p>
            <img class="img-fluid w-50" src="{{asset('assets/img/admin.png')}}">
        </div>
    </div>
@else
<form action="{{route('users.activity',['id' => $user->id])}}" method="GET">
    <div class="row">
        <div class="sidebar-widget my-3">
            <h3 class="sidebar-title">Prikaz aktivnosti po datumu za korisnika {{$user->uName}}</h3>
            <div class="widget-container">
                <form>
                    <input class="date form-control" type="date" min="14.3.2021." placeholder="Odaberite datum"/>
                </form>
            </div>
        </div>
    </div>
</form>

<table class="table table-condensed text-center">
    <thead >
    <td>ID</td>
    <td>Akcija</td>
    <td>Datum</td>
    <td>Opcije</td>
    </thead>
    <tbody id="adminAktivnosti" class="">
    @php
            function ispisDatum($ts){
                $date = new dateTime($ts);
                $dt = $date->format("d.m.Y. H:i:s");
                return $dt;
            }
    @endphp

    @foreach($activity as $a)
        <tr id="a_id_{{$a->id}}">
            <td>{{$a->id}}</td>
            <td>{{$a->activity}}</td>
            <td>{{ispisDatum($a->lDate)}}
            </td>
            <td>
                @csrf
                <button type="submit" class="btn btn-outline-secondary deleteActivity" value="{{$a->id}}">Obriši</button>
            </td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>

        {{$activity->links('vendor.pagination.bootstrap-4')}}
@endsection
