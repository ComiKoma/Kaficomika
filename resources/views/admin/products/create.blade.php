@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1 class="my-4">Kreiraj novi proizvod</h1>
        <hr />
        <div class="row">
            <div class="col-md-12">

                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="pName" class="form-control" placeholder="Naziv proizvoda">
                    </div>
                    <div class="form-group">
                        <input type="text" name="pEngName" class="form-control" placeholder="Engleski naziv">
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" class="form-control" placeholder="Cena proizvoda">
                    </div>
                    <div class="list-group">
                        @foreach($kategorije as $k)
                            <li class="list-group-item radio-item">
                                <input {{$k->id == 1 ? "checked='checked'" : ""}} type="radio" name="cId" id="{{$k->id}}" value="{{$k->id}}" name="{{$k->cName}}" class="categories"/> {{$k->cName}}<small class="text-muted"> -  {{$k->cEngName}}</small>
                            </li>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="" for="pImg">Odaberi fotografiju proizvoda</label>
                        <input type="file" class="form-control" id="pImg" name="pImg" />
                    </div>


                    <button type="submit" class="btn btn-outline-secondary">Sačuvaj</button>
                </form>
            </div>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection
