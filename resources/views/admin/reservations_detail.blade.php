@extends("layouts.admin.admin")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Hotel Details Page</h1>
                </div>
                @if ($details->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hotel</th>
                        <th scope="col">Pension Type</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($details as $detail)
                    <tr>
                        <th scope="row">{{$detail->id}}</th>
                        <td>{{$detail->hotel->name}}</td>
                        <td>
                            @if($detail->pension_type == 1)
                               Ultra Her Şey Dahil
                            @elseif($detail->pension_type == 2)
                               Her Şey Dahil
                            @elseif($detail->pension_type == 3)
                              Tam Pansiyon
                            @elseif($detail->pension_type == 4)
                               Yarı Pansiyon
                            @endif
                        </td>
                        <td>{{$detail->price}}</td>

                    </tr>
                    @endforeach


                    </tbody>
                </table>
                @else
                    <h4>There is no hotel details yet</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
