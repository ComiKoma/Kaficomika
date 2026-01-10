@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1 class="my-4">Kreiraj novog korisnika</h1>
        <hr />
        <div class="row">
            <div class="col-md-12">

                <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="uName" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" name="uEmail" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="text" name="uPass" class="form-control" placeholder="Lozinka">
                    </div>
                    <div class="list-group my-2">
                        <li class="list-group-item radio-item">
                            <input type="radio" name="uAdmin" id="" value="1" class="categories"/>Admin<small class="text-muted"></small>
                        </li>
                        <li class="list-group-item radio-item">
                            <input checked="checked" type="radio" name="uAdmin" id="" value="0" class="categories"/>Običan korisnik<small class="text-muted"></small>
                        </li>
                    </div>
                    <div class="list-group my-2">
                        <li class="list-group-item radio-item">
                            <input checked="checked" type="radio" name="uStatus" id="" value="1" class="categories"/>Aktivan nalog<small class="text-muted"></small>
                        </li>
                        <li class="list-group-item radio-item">
                            <input type="radio" name="uStatus" id="" value="0" class="categories"/>Neaktivan nalog<small class="text-muted"></small>
                        </li>
                    </div>

{{--
                    <div class="form-group">
                        <label class="" for="pImg">Odaberi fotografiju korisnika</label>
                        <input type="file" class="form-control" id="pImg" name="pImg" />
                    </div>
--}}


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
