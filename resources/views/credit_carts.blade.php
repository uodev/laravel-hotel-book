@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1>Kredi Kartlarım</h1>
                <div class="d-flex flex-wrap gap-3">
                    <div>
                        <a href="{{route('user.profile.credit-carts.add')}}" class="btn btn-success d-block">
                            New Credit Card
                        </a>
                    </div>

                    @if ($cards->count() > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Card Owner</th>
                                <th scope="col">Card Number</th>
                                <th scope="col">Expiration Date</th>
                                <th scope="col">CVC</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cards as $card)
                                <tr>
                                    <th scope="row">{{$card->id}}</th>
                                    <td>{{$card->name}}</td>
                                    <td>
                                        {{$card->card_number}}
                                    </td>
                                    <td>
                                        {{$card->expiration_date}}
                                    </td>
                                    <td>
                                        {{$card->cvc}}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="w-100">
                            <h5>There is no credit cards yet</h5>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
