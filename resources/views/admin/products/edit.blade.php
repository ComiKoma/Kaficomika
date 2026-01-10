@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1 class="my-4">Izmena proizvoda - {{$proizvodi->pName}}</h1>
        <hr />
    <div class="row">
        <div class="col-md-12">

            <form action="{{route('products.update', ['product' => $proizvodi->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" name="pName" class="form-control" value="{{$proizvodi->pName}}" placeholder="Naziv proizvoda">
            </div>
            <div class="form-group">
                <input type="text" name="pEngName" class="form-control" value="{{$proizvodi->pEngName}}" placeholder="Cena proizvoda">
            </div>
            <div class="form-group">
                <input type="text" name="price" class="form-control" value="{{$proizvodi->price}}" placeholder="Cena proizvoda">
            </div>
            <div class="list-group">
                @foreach($kategorije as $k)
                    <li class="list-group-item radio-item">
                        <input {{$proizvodi->cId == $k->id ? "checked='checked'" : ""}} type="radio" name="cId" id="{{$k->id}}" value="{{$k->id}}" name="{{$k->cName}}" class="categories"/> {{$k->cName}}<small class="text-muted"> -  {{$k->cEngName}}</small>
                    </li>
                @endforeach
            </div>
            <div class="form-group">
                <label class="" for="image">Izmeni fotografiju proizvoda</label>
                <input type="file" class="form-control" id="image" name="image" value="{{$proizvodi->pImg}}"/>
            </div>

            <button type="submit" class="btn btn-outline-secondary">Izmeni</button>
            </form>
        </div>

    </div>

    @if($errors->any())
        <div class="alert alert-danger my-3">
            @foreach ($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
    @endif
    </div>
@endsection
