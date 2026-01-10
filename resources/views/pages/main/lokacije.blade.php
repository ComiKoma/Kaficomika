@extends('layouts.layout')
@section('title')
    Lokacije
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
    <!-- Page Content -->
<div class="page-heading contact-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h1 class="my-4">Razbudite se kod nas!</h1>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="find-us">
    <div class="container">
        <div class="row">
            <?php
            foreach ($loc as $l):
            ?>
            <div class="loc col-md-12 my-2 text-center">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>{{$l->lName}}</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="left-content">
                    <p>Telefon: {{$l->phone}}</p>
                    <p>Radno vreme: {{$l->workingHours}}</p>
                </div>
            </div>
            <div class="col-md-12">
                <div id="map">
                    <iframe src="{{$l->iFrame}}" width="100%" height="330px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            </div>
            <?php
              endforeach;  ?>
        </div>
    </div>
</div>

@endsection
