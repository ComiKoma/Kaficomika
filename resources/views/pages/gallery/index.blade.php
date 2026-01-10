@extends('layouts.layout')
@section('title')
    Kaficomika - Galerija
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
    <div class="container">
    <h1 class="my-4">NAŠ KUTAK - VAŠE SLIKE</h1>
    <hr/>
        <div class="row">

    <div class="card-columns">

        <div class="card bg-secondary text-white text-center p-3">
            <blockquote class="blockquote mb-0">
                <p>Dobra komunikacija podsticajna je jednako kao i crna kafa i jednako je teška za spavanje.</p>
                <footer class="blockquote-footer">
                    <small>
                        Anne Morrow Lindbergh <cite title="Source Title">About coffee</cite>
                    </small>
                </footer>
            </blockquote>
        </div>
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Želiš i ti da tvoje remek delo postane deo naše galerije?</h5>
                <p class="card-text">Prijavi se!</p>
            </div>
        </div>

        <?php
        function ispisDatum($ts){
            $date = new dateTime($ts);
            $dt = $date->format("d.m.Y. H:i");
            return $dt;
        }
        foreach ($img as $i):
        ?>
        <div class="card">
            <img class="card-img-top" src="{{asset('assets/img/gallery/'.$i->gSrc)}}" alt="Card image cap">
            <div class="card-body">
                <p class="card-text"><small class="text-muted">{{ispisDatum($i->date)}}  {{$i->gDescription ? '-'.$i->gDescription : ''}}</small></p>
            </div>
        </div>
<?php

            endforeach;
            ?>

    </div>
        </div>
    </div>
@endsection
