@extends("layouts.admin.admin")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Reservations Page</h1>
                </div>
                @if ($reservations->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Hotel</th>
                        <th scope="col">Price</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Person Count</th>
                        <th scope="col">Checkin Date</th>
                        <th scope="col">Checkout Date</th>
                        <th scope="col">Actions</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($reservations as $reservation)
                    <tr>
                        <th scope="row">{{$reservation->id}}</th>
                        <td>{{$reservation->user->name}}</td>
                        <td>{{$reservation->hotel->name}}</td>
                        <td>{{$reservation->hotel_price}}</td>
                        <td>{{$reservation->phone}}</td>
                        <td>{{$reservation->person_count}}</td>
                        <td>{{$reservation->checkin_date}}</td>
                        <td>{{$reservation->checkout_date}}</td>
                        <td>
                            <a href="#" class="btn-warning btn">Details</a>
                        </td>
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
