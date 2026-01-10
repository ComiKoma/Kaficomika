@extends('layouts.admin')
@section('title')
    AdminPanel - Products
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
<form action="{{route('products.index')}}" method="GET">
    <div class="row">
        <div class="col-md-12 my-3">
            <input type="text" placeholder="Pretraga" class="form-control search">
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" checked="checked"name="sort" data-id="id" value="asc" class="sort"/> ID rastuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="id" value="desc" class="sort"/> ID opadajuće <small class="text-muted"></small>
        </div>

        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="pName" value="desc" class="sort"/> Naziv opadajuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="pName" value="asc" class="sort"/> Naziv rastuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="price" value="desc" class="sort"/> Cena opadajuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="price" value="asc" class="sort"/> Cena rastuće <small class="text-muted"></small>
        </div>

        <div class="col-md-12 my-3">
            <a href="{{route('products.create')}}" class="form-control btn btn-outline-secondary">Dodaj proizvod</a>
        </div>
    </div>
</form>
<table class="table table-condensed table-bordered text-center">
    <thead >
        <td>ID</td>
        <td>Naziv</td>
        <td>Engleski naziv</td>
        <td>Cena</td>
        <td>Kategorija</td>
        <td colspan="2">Opcije</td>
    </thead>
    <tbody id="adminProizvodi" class="">
    @foreach($proizvod as $p)
    <tr id="product_id_{{$p->id}}">
        <td>{{$p->id}}</td>
        <td>{{$p->pName}}</td>
        <td>{{$p->pEngName}}</td>
        <td>{{$p->price}} din.</td>
        <td>{{$p->categories->cName}}</td>
        <td colspan="1">
            <a href="{{route('products.edit', $p->id)}}" class="btn btn-outline-secondary" role="button">Izmeni</a>

        </td>
        <td>
                @csrf
                <button type="submit" class="btn btn-outline-secondary deleteProduct" value="{{$p->id}}">Obriši</button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
    {{$proizvod->links('vendor.pagination.bootstrap-4')}}
@endsection
