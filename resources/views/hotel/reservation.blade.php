@extends("layouts.hotel.hotel")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">

                    <h1>Hotels Reservation Page</h1>
                </div>
                @if ($hotel_details->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Per Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Pension Type</th>
                            <th scope="col">Checkin Date</th>
                            <th scope="col">Checkout Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($hotel_details as $hotel)
                            <tr>
                                <th scope="row">{{$hotel->id}}</th>
                                <td>{{$hotel->user->name}}</td>
                                <td>{{$hotel->phone}}</td>
                                <td>{{$hotel->room->price}}</td>
                                <td>{{$hotel->hotel_price}}</td>
                                <td>
                                    @if ($hotel->room->pension_type == 1)
                                        Ultra Her Sey Dahil
                                    @elseif($hotel->room->pension_type ==3)
                                        Tam Pansiyon
                                    @elseif($hotel->room->pension_type ==4)
                                        Yari Pansiyon
                                    @else
                                        Her Sey Dahil
                                    @endif
                                </td>
                                <td>{{$hotel->checkin_date}}</td>
                                <td>{{$hotel->checkout_date}}</td>
                                <td>
                                    @if ($hotel->status == 0)
                                        <span class="badge bg-warning">Bekleniyor</span>
                                    @elseif($hotel->status == 1)
                                        <span class="badge bg-success">Onaylandı</span>
                                    @else
                                        <span class="badge bg-danger">İptal Edildi</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('hotel.reservation.confirm' , $hotel->id)}}" class="btn btn-primary">Onayla</a>
                                    <a href="{{route('hotel.reservation.cancel', $hotel->id)}}" class="btn btn-danger">İptal Et</a>
                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>There is no reservation yet</h4>
                @endif
            </div>
        </div>
    </div>

@endsection
