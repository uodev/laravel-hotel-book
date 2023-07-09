@extends("layouts.hotel.hotel")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Hotels Details Add Page</h1>
                </div>
                <form action="{{route('hotel.detail.create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="hotelPensionType" class="form-label">Pension Type</label>
                        <select name="pensionType" id="hotelPensionType" class="form-control" required>
                            <option value="1">Ultra Her Sey Dahil</option>
                            <option value="2">Her Sey Dahil</option>
                            <option value="3">Tam Pansiyon</option>
                            <option value="4">Yari Pansiyon</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" value="1000" name="price" class="form-control" min="1000" max="100000" id="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="hotelImage" class="form-label">Hotel Image</label>
                        <input type="text" name="image" class="form-control" id="hotelImage" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
