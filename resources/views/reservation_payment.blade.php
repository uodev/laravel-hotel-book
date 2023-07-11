@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <h1>Reservation Payment Page</h1>
                <div class="d-flex flex-column align-items-center">
                    <div class="alert alert-warning">
                        <h5>Total Price: <span> {{$reservation['hotel_price']}}</span></h5>
                    </div>

                    <div class="col-lg-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('user.reservation.payment.create')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="card_name" class="form-label">Full Name</label>
                                <input type="text" name="card_name" minlength="2" maxlength="30"
                                       class="form-control" id="card_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" maxlength="19" minlength="19" oninput="formatCardNumber()"
                                       name="card_number" class="form-control" id="card_number" required>
                            </div>

                            <div class="mb-3">
                                <label for="card_month" class="form-label">Expiration Date</label>
                                <div class="d-flex" style="width: 100%">
                                    <select name="card_month" id="card_month" class="form-select"
                                            aria-label="Default select example">
                                        <option value="">Month</option>
                                        @foreach(range( 1, 12 ) as $month )
                                            <option value="{{$month}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                    <select name="card_year" id="card_year" class="form-select"
                                            aria-label="Default select example">
                                        <option value="">Year</option>
                                        @foreach(range( date('Y'), date('Y') + 15 ) as $year )
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3" style="width: 50%">
                                <label for="card_cvc" class="form-label">CVC</label>
                                <input oninput="this.value = this.value.replace(/[^0-9]/g, '')" type="text"
                                       minlength="3" maxlength="3" name="card_cvc" class="form-control"
                                       id="card_cvc" required>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Make Reservation</button>
                        </form>
                    </div>

                    <div class="alert alert-warning">
                        <strong>Warning!</strong> You can select saved cards!
                    </div>

                    <table class="table col-lg-8">
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
                                    {{substr_replace($card->card_number, '**** **** **** ', 0, 15)}}
                                </td>
                                <td>
                                    {{$card->expiration_date}}
                                </td>
                                <td>
                                    {{$card->cvc}}
                                </td>
                                <td>
                                    <button
                                        onclick="filledSection('{{$card->name}}', '{{$card->card_number}}', '{{$card->expiration_date}}', '{{$card->cvc}}')"
                                        class="btn btn-warning">Select
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection

<script>
    function formatCardNumber() {
        let cardNumber = document.getElementById('card_number').value;
        cardNumber = cardNumber.replace(/[^\d]/g, '');
        cardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1 ');
        document.getElementById('card_number').value = cardNumber;
    }

    function filledSection(card_name, card_number, card_month, card_cvc) {
        document.getElementById('card_name').value = card_name;
        document.getElementById('card_number').value = card_number;
        document.getElementById('card_cvc').value = card_cvc;
        const formatDate = card_month.split('/');
        document.getElementById('card_year').value = formatDate[1];
        if (formatDate[0] < 10)
            document.getElementById('card_month').value = formatDate[0].replace('0', '');
        else
            document.getElementById('card_month').value = formatDate[0];
    }
</script>

