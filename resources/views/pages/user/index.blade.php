@extends('layouts.admin')
@section('content')

    @if(session()->has("user") || session()->has("admin"))
    @php

        if(session()->has("user") )
            $rola = "user";
        if(session()->has("admin"))
            $rola = "admin"
    @endphp

    <div class="container">
        <h1 class="my-4">Izmena naloga - {{session($rola)->uName}}</h1>
        <hr />
        <div class="row">
            <div class="col-md-12">

                <form action="{{route('user.update', ['id' => session($rola)->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" name="uName" class="form-control" value="{{session($rola)->uName}}" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" name="uEmail" class="form-control" value="{{session($rola)->uEmail}}" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" name="uPass" class="form-control" value="" placeholder="Lozinka">
                    </div>
                    <div class="list-group my-2">
                        <li class="list-group-item radio-item">
                            <input checked='checked' type="radio" name="uStatus" id="{{session($rola)->id}}" value="1" name="{{session($rola)->uStatus}}" class="status"/>Aktivan nalog<small class="text-muted"></small>
                        </li>
                        <li class="list-group-item radio-item">
                            <input type="radio" name="uStatus" id="{{session($rola)->id}}" value="0" name="{{session($rola)->uStatus}}" class="status"/>Deaktiviran nalog<small class="text-muted"></small>
                        </li>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger my-3">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br/>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn btn-outline-secondary">Izmeni</button>
                </form>
            </div>

        </div>
    </div>
    @else
        <div class="container padding">
            <div class="row text-center my-3">
                <img src="{{asset("assets/img/404.png")}}" alt="404" class="img-fluid mx-auto d-block"/>
            </div>
        </div>
    @endif
@endsection
