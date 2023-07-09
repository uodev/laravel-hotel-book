@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1>Hotels Detail</h1>
                @if(!$details->isEmpty())
                <div class="d-flex flex-wrap gap-3">

                    @foreach($details as $detail)
                        <div class="card" style="width: 18rem;">
                            <img
                                src="{{$detail->room_image}}"
                                class="card-img-top" alt="detail photo">
                            <div class="card-body">
                                @if($detail->pension_type == 1)
                                    <h5 class="card-title">Ultra Her Şey Dahil</h5>
                                @elseif($detail->pension_type == 2)
                                    <h5 class="card-title">Her Şey Dahil</h5>
                                @elseif($detail->pension_type == 3)
                                    <h5 class="card-title">Tam Pansiyon</h5>
                                @elseif($detail->pension_type == 4)
                                    <h5 class="card-title">Yarı Pansiyon</h5>
                                @endif
                                <p class="card-text">Price: {{$detail->price}}₺</p>

                                <button onclick="addReservation({{$detail->id}},{{$detail->hotel->id }},'{{$detail->hotel->name}}','{{$detail->price}}')"
                                        class="btn btn-primary">Make Reservation
                                </button>

                            </div>
                        </div>
                    @endforeach

                </div>
                @else
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>There is no room for this hotel</p>
                        <hr>
                        <p class="mb-2">You can check other hotels</p>
                        <a href="{{route('home')}}" class="text-decoration-none" style="color: gray;">Home</a>
                    </div>
                @endif
            </div>
{{--                        if user is login show reservation form--}}
            @if(auth()->check())

                <div class="col-lg-3" style="position: fixed; right: 15%; top: 8%;width: 15% ">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center">

                            <h4>Select Hotel for Reservation</h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('user.reservation')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input  type="text" readonly name="hotel_id" class="form-control"
                                        id="hotelId" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" readonly name="detailId" class="form-control"
                                        id="detailId" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" readonly id="hotelPrice" name="hotelPrice" class="form-control"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="hotelName" class="form-label">Hotel Name</label>
                                <input type="text" value="" readonly name="hotel_name" class="form-control" id="hotelName"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="userPhone" class="form-label">Phone Number</label>
                                <input type="tel" name="phone" maxlength="11" minlength="10" class="form-control"
                                       id="userPhone" required>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Person Count</label>
                                <select onchange="changePrice()" name="person_count" class="form-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="checkin_date" class="form-label">Giriş tarihi ve kaç gün kalacağınız:</label>
                                <div class=" d-flex align-items-center">
                                    <input type="date" id="checkin_date" class="form-control flex-grow-1" name="checkin_date" required>
                                    <input type="number" onchange="changePrice()" min="1" max="12" placeholder="Gün Sayısı" name="count_day" value="1" id="count_day" class="form-control flex-grow-0" required>
                                </div>
                            </div>



                            <div class="d-flex align-items-center  justify-content-between">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <h5 id="hotelPriceTotal" class="mt-2 h-75">Price: 0₺</h5>
                            </div>
                            <div class="mb-3">
                                <input hidden type="text"  readonly id="hotel_price" name="hotel_price" class="form-control"
                                       required>
                            </div>
                        </form>

                    </div>
                </div>

            @else
                <div class="col-lg-3" >
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>You must login for reservation</p>
                        <hr>
                        <p class="mb-2">If you don't have account, you can register</p>
                        <a href="{{route('register')}}" class="text-decoration-none" style="color: gray;">Register</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function addReservation(id,hotelIdDB, name, price) {
            const detailId = document.getElementById("detailId");
            const hotelId = document.getElementById("hotelId");
            const hotelPriceHtml = document.getElementById("hotelPrice");
            const hotelName = document.getElementById("hotelName");
            const hotelPriceTotal = document.getElementById("hotelPriceTotal");
            const hotel_price = document.getElementById("hotel_price");
            const count_day = document.getElementById("count_day");
            const hotelTotalPriceInt = parseInt(price);
            const totalPriceWithPerson = hotelTotalPriceInt * document.querySelector("select[name='person_count']").value * count_day.value;
            hotelPriceTotal.innerHTML = "Price: " + totalPriceWithPerson + "₺";
            hotelId.value = hotelIdDB;
            hotelPriceHtml.value = price;
            detailId.value = id;
            hotelName.value = name;
            hotel_price.value = totalPriceWithPerson;
        }

        function changePrice() {
            const hotelPrice = document.getElementById("hotelPrice");
            const hotel_price = document.getElementById("hotel_price");
            const hotelPriceTotal = document.getElementById("hotelPriceTotal");
            const count_day = document.getElementById("count_day");
            if (hotelPrice.value === "") {
                hotelPriceTotal.innerHTML = "Price: 0₺";
                return;
            }
            const hotelTotalPriceInt = parseInt(hotelPrice.value);
            const totalPriceWithPerson = hotelTotalPriceInt * document.querySelector("select[name='person_count']").value * count_day.value;
            hotelPriceTotal.innerHTML = "Price: " + totalPriceWithPerson + "₺";
            hotel_price.value = totalPriceWithPerson;
        }


    </script>

@endsection

