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
                            <th scope="col">Actions</th>
                            <th scope="col">Status</th>
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
                                    <p class="text-warning">Bekleniyor</p>
                                </td>
                                <td>
                                    <button class="btn btn-primary">Action</button>
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
