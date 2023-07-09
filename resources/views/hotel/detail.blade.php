@extends("layouts.hotel.hotel")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Hotels Details Page</h1>
                    <a href="{{route('hotel.detail.add')}}" class="btn btn-success me-5">Create</a>
                </div>
                @if ($hotel_details->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pension Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Hotel</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($hotel_details as $hotel)
                        <tr>
                            <th scope="row">{{$hotel->id}}</th>
                            <td>{{$hotel->name}}</td>
                            <td>
                                @if ($hotel->pension_type == 1)
                                    Ultra Her Sey Dahil
                                @elseif($hotel->pension_type ==3)
                                    Tam Pansiyon
                                @elseif($hotel->pension_type ==4)
                                    Yari Pansiyon
                                @else
                                    Her Sey Dahil
                                @endif
                            </td>
                            <td>
                                {{$hotel->hotel->name}}
                            </td>

                        </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>There is no hotel yet</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
