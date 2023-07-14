<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelReservationDetailsRequest;
use App\Http\Resources\HotelReservationDetailsResource;
use App\Models\HotelDetails;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class HotelReservationDetailsController extends Controller
{
    public function index()
    {
        $hotelDetails = HotelReservationDetailsResource::collection(Reservation::paginate(10));

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
        $hotel = HotelReservationDetailsResource::make($hotelDetails);

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
        $hotel = HotelReservationDetailsResource::make($hotelDetails);

        return response()->json([
            'success' => true,
            'data' => $hotel
        ], 200);
    }

}
