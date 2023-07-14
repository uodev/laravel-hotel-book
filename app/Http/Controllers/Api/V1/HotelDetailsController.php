<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelDetailsRequest;
use App\Http\Resources\HotelDetailsResource;
use App\Models\HotelDetails;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class HotelDetailsController extends Controller
{
    public function index()
    {
        $hotelDetails = HotelDetailsResource::collection(Reservation::paginate(10));

        return response()->json([
            'success' => true,
            'currentPage' => $hotelDetails->currentPage(),
            'totalPage' => $hotelDetails->lastPage(),
            'data' => $hotelDetails
        ]);
    }

    public function show($id)
    {
        $hotelDetails = Reservation::find($id);
        if (!$hotelDetails){
            return response()->json([
                'success' => false,
                'message' => 'Hotel details not found'
            ], 404);
        }
        $hotel = HotelDetailsResource::make($hotelDetails);

            return response()->json([
                'success' => true,
                'data' => $hotel
            ], 404);

    }

    public function update($reservationId,Request $request)
    {

        $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'type' => 'required|integer',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validated->errors()
            ], 400);
        }

        $hotelDetails = Reservation::find($reservationId);

        if (!$hotelDetails){
            return response()->json([
                'success' => false,
                'message' => 'Hotel details not found'
            ], 404);
        }
        if ($request->type == 1) {
            $hotelDetails->status = 1;
        } else {
            $hotelDetails->status = 2;
        }
        $hotelDetails->save();
        $hotel = HotelDetailsResource::make($hotelDetails);

        return response()->json([
            'success' => true,
            'data' => $hotel
        ], 200);
    }

}
