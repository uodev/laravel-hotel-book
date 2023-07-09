@extends("layouts.admin.admin")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Hotels Page</h1>
                    <a href="{{route('admin.hotels.create')}}" class="btn btn-success me-5">Create</a>
                </div>
                @if ($hotels->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Star</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Pension Type</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($hotels as $hotel)
                    <tr>
                        <th scope="row">{{$hotel->id}}</th>
                        <td>{{$hotel->name}}</td>
                        <td>{{$hotel->address}}</td>
                        <td>{{$hotel->star}}</td>
                        <td>{{$hotel->phone}}</td>
                        <td>
                            @if ($hotel->pensionType ==2)
                                Ultra Her Sey Dahil
                            @elseif($hotel->pensionType ==3)
                                Tam Pansiyon
                            @elseif($hotel->pensionType ==4)
                                Yari Pansiyon
                            @else
                                Her Sey Dahil
                            @endif

                        </td>
                        <td>{{$hotel->price}}</td>
                        <td>
                            <a href="{{route('admin.reservations.detail', $hotel->id)}}" class="btn btn-info">Detail</a>
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
