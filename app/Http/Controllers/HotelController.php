<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelDetails;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        return view('hotel.index');
    }

    public function login()
    {
        return view('hotel.login');
    }

    public function getLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $findUser = Hotel::where('email', $request->email)->first();
        if (!$findUser) {
            return redirect()->back()->withErrors('Böyle bir kullanıcı bulunamadı.');
        }

//        if (!Hash::check($request->password, $findUser->password)) {
//            return redirect()->back()->withErrors('Şifreniz hatalı.');
//        }

        session(['hotel' => $findUser]);

        return redirect()->route('hotel.index');
    }

    public function logout()
    {
        session()->forget('hotel');
        return redirect()->route('hotel.login');
    }

    public function getDetail()
    {
        $hotelId = session('hotel')->id;
        $hotel_details = HotelDetails::where('hotel_id', $hotelId)->get();
        return view('hotel.detail', compact('hotel_details'));
    }

    public function addDetail()
    {
        return view('hotel.addDetail');
    }

    public function createDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pensionType' => 'required',
            'price' => 'required',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $hotelId = session('hotel')->id;

        $hotelDetail = new HotelDetails();
        $hotelDetail->hotel_id = $hotelId;
        $hotelDetail->pension_type = $request->pensionType;
        $hotelDetail->price = $request->price;
        $hotelDetail->room_image = $request->image;
        $hotelDetail->save();

        return redirect()->route('hotel.detail.get');
    }

    public function reservertaion()
    {
        $hotelId = session('hotel')->id;
        $hotel_details = Reservation::where('hotel_id', $hotelId)->get();
        return view('hotel.reservation', compact('hotel_details'));
    }
}
