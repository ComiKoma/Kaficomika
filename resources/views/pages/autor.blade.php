@extends("layouts.layout")
@section("content")
<div class="container">
    <div class="row justify-content-center col-md-12 text-center my-3">
        <div class="row">

        <?php
        foreach($autor as $a):
        ?>
        <div class="col-md-12">
            <h5 class="card-title">{{$a->naslov}}</h5>
            <img src="{{asset("assets/img/".$a->slika)}}" class="img-fluid w-50" alt="{{$a->naslov}}">
        </div>
        <div class="col-md-12">
            <div class="card-body my-3">

                <p>
                    {{$a->opis}}
                </p>
            </div>
            <div class="row text-center padding">
                <div class="col-md-4 social padding"><a href="https://www.instagram.com/comikomakeup/"><i class="fa fa-instagram"></i></a></div>
                <div class="col-md-4 social padding"><a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a></div>
                <div class="col-md-4 social padding"><a href="https://www.tumblr.com"><i class="fab fa-tumblr"></i></a></div>
            </div>
            <div>
                <a href="{{$a->dokumentacija}}" class="btn btn-outline-secondary">Dokumentacija</a>
            </div>
        </div>
        <?php
        endforeach;
        ?>
        </div>
    </div>
</div>
    @endsection
