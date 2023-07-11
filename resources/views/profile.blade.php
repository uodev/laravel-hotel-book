@extends('layouts.app')

@section('content')
    <h1>User Details Page</h1>

        <a href="{{route('user.profile.credit-carts')}}" class="btn btn-secondary">Kredi Kartlarım</a>
        <a href="{{route('user.profile.reservations')}}" class="btn btn-secondary">Rezervasyonlarım</a>
@endsection
