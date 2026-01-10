@extends('layouts.layout')
@section('title')
     O nama
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
    <div class="container py-4">
        <div class="row">
            <h1>O nama</h1>
            <hr />
            <?php foreach($onama as $o): ?>
            <div>
                <p class="my-4">{{$o->p1}}</p>
                <div class="row">
                    <p class="col-md-6 my-4">{{$o->p2}}</p>
                <img class="col-md-6" src="{{asset('assets/img/gallery/'.$o->slika1)}}" alt="onama">
                </div>

                <div class="row">
                <img class="col-md-6" src="{{asset('assets/img/gallery/'.$o->slika2)}}" alt="onama">
                    <p class="col-md-6 my-4">{{$o->p3}}</p>
                </div>

            </div>
            <?php endforeach; ?>

        </div>

    </div>
@endsection


