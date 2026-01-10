@extends('layouts.layout')
@section('title')
    Kontakt
@endsection
@section('description')
    Website for a cafeteria
@endsection
@section('keywords')
    kafeterija, online, cafe, kafić, kafic, kafica, kafidžonka, kafidzonka, kafidzonika, espreso, espresso, makijato, macciato
@endsection
@section('content')
<div class="container py-4">
        <div class="mb-4">
            <h1>Kontaktirajte nas</h1>
            <hr />
            <form>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-secondary">Submit</button>
            </form>
        </div>
    </div>
@endsection
