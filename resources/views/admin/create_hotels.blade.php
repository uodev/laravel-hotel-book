@extends("layouts.admin.admin")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                    <h1>Hotels Create Page</h1>
                    <a href="{{route('admin.hotels')}}" class="btn btn-success me-5">Hotels List</a>
                </div>
                <form action="{{route('admin.hotels.create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="hotelEmail" class="form-label">Hotel Email</label>
                        <input type="text" name="email" class="form-control" id="hotelEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="hotelPassword" class="form-label">Hotel Password</label>
                        <input type="password" name="password" class="form-control" id="hotelPassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="hotelName" class="form-label">Hotel Name</label>
                        <input type="text" name="name" class="form-control" id="hotelName" required>
                    </div>

                    <div class="mb-3">
                        <label for="hotelCity" class="form-label">Hotel City</label>
                        <input type="text" name="city" class="form-control" id="hotelCity" required>
                    </div>

                    <div class="mb-3">
                        <label for="hotelPhone" class="form-label">Hotel Phone</label>
                        <input type="tel" name="phone" class="form-control" id="hotelPhone" required>
                    </div>


                    <div class="mb-3">
                        <label for="hotelStar" class="form-label">Hotel Star</label>
                        <input type="number" name="star" value="1" max="5" min="1" class="form-control" id="hotelStar" required>
                    </div>



                    <div class="mb-3">
                        <label for="hotelImage" class="form-label">Hotel Image Link</label>
                        <input type="text" name="image" class="form-control" id="hotelImage" required>
                    </div>


                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
