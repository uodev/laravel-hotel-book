@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">

                    <h1>Your Reservations</h1>
                </div>
                <hr>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                @if ($reservations->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Hotel</th>
                            <th scope="col">Price</th>
                            <th scope="col">Checkin Date</th>
                            <th scope="col">Checkout Date</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($reservations as $reservation)
                            <tr>
                                <th scope="row">{{$reservation->id}}</th>
                                <td>{{$reservation->user->name}}</td>
                                <td>{{$reservation->phone}}</td>
                                <td>{{$reservation->hotel->name}}</td>
                                <td>{{$reservation->hotel_price}}</td>
                                <td>{{$reservation->checkin_date}}</td>
                                <td>{{$reservation->checkout_date}}</td>
                                <td>
                                    @if ($reservation->status == 0)
                                        <span class="badge bg-warning">Bekleniyor</span>
                                    @elseif($reservation->status == 1)
                                        <span class="badge bg-success">Onaylandı</span>
                                    @else
                                        <span class="badge bg-danger">İptal Edildi</span>
                                    @endif
                                </td>
                                {{--                                <td>--}}
                                {{--                                    <a href="{{route('hotel.reservation.confirm' , $hotel->id)}}" class="btn btn-primary">Onayla</a>--}}
                                {{--                                    <a href="{{route('hotel.reservation.cancel', $hotel->id)}}" class="btn btn-danger">İptal Et</a>--}}
                                {{--                                </td>--}}

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>There is no reservations yet</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
