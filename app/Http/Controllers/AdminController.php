<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelDetails;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.index');
    }

    function getUser()
    {
        $users = User::get();
        return view('admin.users', compact('users'));
    }

    function getHotels()
    {
        $hotels = Hotel::get();
        return view('admin.hotels', compact('hotels'));
    }

    function createHotels()
    {
        return view('admin.create_hotels');
    }

    function storeHotels(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'name' => 'required',
            'city' => 'required',
            'phone' => 'required|string|min:10|max:11',
            'star' => 'required|numeric|min:1|max:5',
            'image'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $bcryptPassword = bcrypt($request->password);

        $hotel = new Hotel();
        $hotel->email = $request->email;
        $hotel->password = $bcryptPassword;
        $hotel->name = $request->name;
        $hotel->city = $request->city;
        $hotel->phone = $request->phone;
        $hotel->star = $request->star;
        $hotel->image = $request->image;
        $hotel->address ="test";

        $hotel->save();

        return redirect()->route('admin.hotels');

    }

    function getReservation()
    {
        $reservations = Reservation::get();
        return view('admin.reservations', compact('reservations'));
    }

    function getReservationDetail($id)
    {
        $details = HotelDetails::where('hotel_id', $id)->get();
        return view('admin.reservations_detail', compact('details'));
    }
}
