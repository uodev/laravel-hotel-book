@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1>Hotels</h1>
                <div class="d-flex flex-wrap gap-3">

                    @foreach($hotels as $hotel)
                        <div class="card" style="width: 18rem;">
                            <img
                                src="{{$hotel->image}}"
                                class="card-img-top" alt="{{$hotel->name}} photo">
                            <div class="card-body">
                                <h5 class="card-title">{{$hotel->name}}</h5>
                                <div class="d-flex w-auto">
                                    @for($i=1;$i<=$hotel->star;$i++)
                                        <span>⭐</span>
                                    @endfor

                                </div>

                                <div class="d-flex flex-column gap-2 mt-2 mb-2">
                                    <span class="card-text">Address</span>
                                    <span>{{$hotel->address}}</span>
                                </div>

                                <a href="{{route('user.reservation.detail',$hotel->id)}}"
                                   class="btn btn-primary">Detayları Gör
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <script>
        function addReservation(id, name, price) {

            const hotelId = document.getElementById("hotelId");
            const hotelPriceHtml = document.getElementById("hotelPrice");
            const hotelName = document.getElementById("hotelName");
            const hotelPriceTotal = document.getElementById("hotelPriceTotal");
            const hotel_price = document.getElementById("hotel_price");
            const count_day = document.getElementById("count_day");
            const hotelTotalPriceInt = parseInt(price);
            const totalPriceWithPerson = hotelTotalPriceInt * document.querySelector("select[name='person_count']").value * count_day.value;
            hotelPriceTotal.innerHTML = "Price: " + totalPriceWithPerson + "₺";
            hotelId.value = id;
            hotelPriceHtml.value = price;
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

