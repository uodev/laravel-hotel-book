<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        //with pagination
        $hotels =HotelResource::collection(Hotel::paginate(10));
        return response()->json([
            'status' => true,
            'page' => $hotels->currentPage(),
            "totalPages" => $hotels->lastPage(),
            'data' => $hotels,
        ], 200);
    }

    public function show($id)
    {
        $findHotel = Hotel::find($id);
        if (!$findHotel) {
            return response()->json([
                'status' => false,
                'message' => 'data not found'
            ], 404);
        }
        $hotel = HotelResource::make($findHotel);

        return response()->json([
            'status' => true,
            'data' => $hotel
        ], 200);
    }

    public function store(HotelRequest $hotel)
    {
        $bcryptPassword = bcrypt($hotel->password);
        $hotelStore = Hotel::create(array_merge($hotel->validated(), ['password' => $bcryptPassword]));
        if (!$hotelStore) {
            return response()->json([
                'status' => false,
                'message' => 'failed to save data'
            ], 400);
        }
        $hotel = HotelResource::make($hotelStore);
        return response()->json([
            'status' => true,
            'data' => $hotel
        ], 201);
    }

    public function update(HotelRequest $hotel, $id)
    {
        $hotelUpdate = Hotel::find($id);
        if (!$hotelUpdate) {
            return response()->json([
                'status' => false,
                'message' => 'data not found'
            ], 404);
        }
        $hotelUpdate->update($hotel->validated());
        return HotelResource::make($hotelUpdate);
    }

    public function destroy($id)
    {
        //softDeletes
        $hotelDelete = Hotel::findOrFail($id);
        $hotelDelete->delete();
        return HotelResource::make($hotelDelete);
    }
}
