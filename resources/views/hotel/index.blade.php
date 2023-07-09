@extends('layouts.hotel.hotel')
@section("hotel_image")
    <img src="{{session()->get('hotel')->image}}" alt="">
    @endsection
@section('content')
   <h1> {{ session()->get('hotel')->name}}</h1>

    <section class="container">
        <div class="row">
        <div class="alert alert-warning col me-3">
            <h4>Hotel Details</h4>
            <p>Buraya toplam kac rezervasyon yapilmis</p>
        </div>
        <div class="alert alert-success col me-3">
            <h4>Money</h4>
            <p>Buraya toplam kazanilan para</p>
        </div>

        <div class="alert alert-danger col me-3">
            <h4>Room</h4>
            <p>Kac oda kaldi vs</p>
        </div>
        </div>
    </section>

@endsection
