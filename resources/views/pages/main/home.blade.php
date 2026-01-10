@extends('layouts.layout')
@section('title')
    Početna
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('slider')
    <div id="slide">
              <span id="image-inner">

              </span>
    </div>
@endsection
@section('content')

    <div class="jumbotron">
        <div class="container text-center">
            <h4 class="display-5">Dobrodošli džezveri!</h4>
            <p class="lead">Sajt na kom ćeš saznati sve o kafi, ukusima.</p>
            <hr class="my-4">
            <p>A možete nas i kontaktirati</p>
            <a class="btn btn-outline-secondary btn-lg" href="{{route('product')}}" role="button">P O N U D A</a>
        </div>
    </div>
@endsection
