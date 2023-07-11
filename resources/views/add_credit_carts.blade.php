@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex flex-column align-items-center justify-content-center gap-4">
            <div class="col-10">
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <h1 class="text-center">Credit Cart Add Page</h1>
                    <a href="{{route('user.profile.credit-carts')}}" class="btn btn-success me-5 text-center">Credit Cart List</a>
                </div>
            </div>
            <div class="col-2">
                <div class="d-flex justify-content-between align-items-center">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{route('user.profile.credit-carts.add')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="card_name" class="form-label">Full Name</label>
                        <input type="text" name="card_name" minlength="2" maxlength="30" class="form-control" id="card_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Card Number</label>
                        <input type="text"  maxlength="19" minlength="19" oninput="formatCardNumber()"
                               name="card_number" class="form-control" id="card_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="card_month" class="form-label">Expiration Date</label>
                        <div class="d-flex" style="width: 50%">
                            <select name="card_month" id="card_month" class="form-select" aria-label="Default select example">
                                <option value="">Month</option>
                                @foreach(range( 1, 12 ) as $month )
                                    <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                            <select name="card_year" class="form-select" aria-label="Default select example">
                                <option value="">Year</option>
                                @foreach(range( date('Y'), date('Y') + 15 ) as $year )
                                    <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3" style="width: 20%">
                        <label for="card_cvc" class="form-label">CVC</label>
                        <input oninput="this.value = this.value.replace(/[^0-9]/g, '')" type="text" minlength="3" maxlength="3" name="card_cvc" class="form-control" id="card_cvc" required>
                    </div>




                    <button type="submit" class="btn btn-primary mt-2">Add Card</button>
                </form>
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
</script>
