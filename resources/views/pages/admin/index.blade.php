@extends('layouts.admin')
@section('title')
    AdminPanel
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
    <div class="jumbotron">
        <div class="container text-center">
            <p class="lead">Dobrodošli u admin panel, izaberite jednu od ponuđenih kategorija!</p>
            <img class="img-fluid w-50" src="{{asset('assets/img/admin.png')}}">
        </div>
    </div>
@endsection
