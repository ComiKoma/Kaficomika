@extends('layouts.layout')
@section('title')
    Meni
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
<div class="container mb-3">
    <div class="card my-4">
        <div class="row no-gutters">
            <div class="col-md-5">
                <img src="{{ $p->pImg ? asset('assets/img/product/' . $p->pImg) : asset('assets/img/default.jpg')}}" class="card-img" alt="{{$p->pName}}">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title">{{$p->pName}} <span class="text-muted">- {{$p->pEngName}}</span></h3>
                    <h4>{{$p->volume ? 'Količina: '. $p->volume .'ml': ''}}</h4>
                    <h4>Cena: {{$p->price}} din.</h4>
                    <h4>Kategorija: {{$k->cName}} <span class="text-muted">- {{$k->cEngName}}</span></h4>
                    <p class="card-text">{{$k->description}}</p>
                    <p class="card-text text-muted">{{$k->cEngDescription}}</p>
                </div>
            </div>

        </div>
    </div>
</div>@endsection
