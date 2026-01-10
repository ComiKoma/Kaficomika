@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1 class="my-4">Izmena korisnika - {{$user->uName}}</h1>
        <hr />
    <div class="row">
        <div class="col-md-12">

            <form action="{{route('users.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" name="uName" class="form-control" value="{{$user->uName}}" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" name="uEmail" class="form-control" value="{{$user->uEmail}}" placeholder="E-mail">
            </div>
            <div class="form-group">
                <input type="text" name="uPass" class="form-control" value="{{$user->uPass}}" placeholder="Lozinka">
            </div>
            <div class="list-group my-2">
                    <li class="list-group-item radio-item">
                        <input {{$user->uAdmin == 1 ? "checked='checked'" : ""}} type="radio" name="uAdmin" id="{{$user->id}}" value="1" class="role"/>Admin<small class="text-muted"></small>
                    </li>
                    <li class="list-group-item radio-item">
                        <input {{$user->uAdmin == 0 ? "checked='checked'" : ""}} type="radio" name="uAdmin" id="{{$user->id}}" value="0" class="role"/>Običan korisnik<small class="text-muted"></small>
                    </li>
            </div>
            <div class="list-group my-2">
                <li class="list-group-item radio-item">
                    <input {{$user->uStatus == 1 ? "checked='checked'" : ""}} type="radio" name="uStatus" id="{{$user->id}}" value="1" class="status"/>Aktivan nalog<small class="text-muted"></small>
                </li>
                <li class="list-group-item radio-item">
                    <input {{$user->uStatus == 0 ? "checked='checked'" : ""}} type="radio" name="uStatus" id="{{$user->id}}" value="0" class="status"/>Deaktiviran nalog<small class="text-muted"></small>
                </li>
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
