@extends('layouts.admin')
@section('title')
    AdminPanel - Users
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
<form action="{{route('users.index')}}" method="GET">
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
            <input type="radio" name="sort" data-id="uName" value="desc" class="sort"/> Naziv opadajuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="uName" value="asc" class="sort"/> Naziv rastuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="uRegistered" value="desc" class="sort"/> Registrovan opadajuće <small class="text-muted"></small>
        </div>
        <div class="col-md-2 my-3">
            <input type="radio" name="sort" data-id="uRegistered" value="asc" class="sort"/> Registrovan rastuće <small class="text-muted"></small>
        </div>

        <div class="col-md-12 my-3">
            <a href="{{route('users.create')}}" class="form-control btn btn-outline-secondary">Dodaj korisnika</a>
        </div>
    </div>
</form>
<table class="table table-condensed table-bordered text-center">
    <thead >
    <td>ID</td>
    <td>Username</td>
    <td>E-mail</td>
    <td>Lozinka</td>
    <td>Status</td>
    <td>Registrovan</td>
    <td>Admin</td>
    <td colspan="4">Opcije</td>
    </thead>
    <tbody id="adminKorisnici" class="">
    @php
        function ispisDatum($ts){
            $date = new dateTime($ts);
            $dt = $date->format("d.m.Y. H:i:s");
            return $dt;
        }
    @endphp
    @foreach($user as $u)
        <tr id="u_id_{{$u->id}}">
            <td>{{$u->id}}</td>
            <td>{{$u->uName}}</td>
            <td>{{$u->uEmail}}</td>
            <td>{{$u->uPass}}</td>
            <td>{{$u->uStatus == 1 ? "Aktivan" : "Deaktiviran"}}</td>
            <td>{{ispisDatum($u->uRegistered)}}</td>
            <td>{{$u->uAdmin == 1 ? "Da" : "Ne"}}</td>

            <td colspan="2">
                <a href="{{route('users.activity', $u->id)}}" class="btn btn-outline-secondary" role="button">Aktivnost</a>

            </td>
            <td>
                <a href="{{route('users.edit', $u->id)}}" class="btn btn-outline-secondary" role="button">Izmeni</a>

            </td>
            <td>
                @csrf
                <button type="submit" class="btn btn-outline-secondary deleteUser" value="{{$u->id}}">Obriši</button>
            </td>
        </tr>
    @endforeach
    </tbody>


</table>
{{$user->links('vendor.pagination.bootstrap-4')}}
@endsection
