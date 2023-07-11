@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row ">
            <div class="col-12">
                <div class="d-flex flex-column align-items-center ">
                    <h1>User Details Page</h1>
                    <div class="d-flex gap-3">
                        <a href="{{route('user.profile.credit-carts')}}" class="btn btn-secondary">Kredi Kartlarım</a>
                        <a href="{{route('user.profile.reservations')}}" class="btn btn-secondary">Rezervasyonlarım</a>
                    </div>
                </div>
                <br>
                {{--       user info         --}}
                <div class="d-flex flex-column align-items-center text-center">
                    <h2>User Info</h2>
                    <div class="row">
                        <div class="col-12">
                            <p>Name: {{$user->name}}</p>
                            <p>Email: {{$user->email}}</p>
                            <p>Phone: {{$user->phone}}</p>
                            <a href="" class="btn btn-primary">Change Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
