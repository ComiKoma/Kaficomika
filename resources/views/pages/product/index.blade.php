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
<!-- Page Content -->
    <div class="container">

        <h1 class="my-4">Zavirite u naš meni</h1>
        <hr />

        <div class="row">

            <div class="col-lg-3">

                <ul class="list-group">
                    Sortiraj po:

                    <li class="list-group-item radio-item">
                        <input type="radio" checked="checked" name="sort" data-id="price" value="desc" class="sort"/> Cena opadajuće <small class="text-muted"></small>
                    </li>

                    <li class="list-group-item radio-item">
                        <input type="radio" name="sort" data-id="price" value="asc" class="sort"/> Cena rastuće <small class="text-muted"></small>
                    </li>
                </ul>
                <ul class="list-group">
                    Kategorije:

                    @foreach($kategorije as $k)
                    <li class="list-group-item">
                        <input type="checkbox" name="categories" id="{{$k->id}}" value="{{$k->id}}" class="categories"/> {{$k->cName}}<small class="text-muted"> -  {{$k->cEngName}}</small>
                    </li>
                    @endforeach
                </ul>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9" >

                        <div class="row" id="proizvodi">
                            @forelse($proizvod as $p)
                                @include('partials.product', ['description' => false])
                            @empty
                                <h2>Nema proizvoda za prikaz.</h2>
                            @endforelse
                        </div>
                <!-- /.row -->

                {{$proizvod->links('vendor.pagination.bootstrap-4')}}


            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection
