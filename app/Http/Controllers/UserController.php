<?php

namespace App\Http\Controllers;

use App\Models\CreditCart;
use App\Models\Hotel;
use App\Models\HotelDetails;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function reservation(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'hotel_name' => 'required',
            'hotel_price' => 'required',
            'person_count' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'phone' => 'required|string|min:10|max:11',
            'detailId' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        //check date is not past
        $checkin_date = date('Y-m-d', strtotime($request->checkin_date));
        $checkout_date = date('Y-m-d', strtotime($request->checkout_date));
        if ($checkin_date < date('Y-m-d') || $checkout_date < date('Y-m-d')) {
            return redirect()->back()->withErrors('Geçmiş tarihler için rezervasyon yapılamaz.');
        }

        //Check reservation date is available
        $checkin_date = date('Y-m-d', strtotime($request->checkin_date));
        $checkout_date = date('Y-m-d', strtotime($request->checkout_date));
        $reservation = Reservation::where('hotel_id', $request->hotel_id)
            ->where('checkin_date', '<=', $checkin_date)
            ->where('checkout_date', '>=', $checkout_date)
            ->first();
        if ($reservation) {
            return redirect()->back()->withErrors('Bu tarihler arasında rezervasyon yapılamaz. Lütfen başka bir tarih, otel veya kalacağınız gün sayısı seçiniz.');
        }
        cache()->put('reservation', $request->all(), 60 * 60 * 24 * 30);


//        $reservation = new Reservation();
//        $reservation->user_id = Auth::id();
//        $reservation->detail_id = $request->detailId;
//        $reservation->hotel_id = $request->hotel_id;
//        $reservation->hotel_name = $request->hotel_name;
//        $reservation->hotel_price = $request->hotel_price;
//        $reservation->person_count = $request->person_count;
//        $reservation->phone = $request->phone;
//        $reservation->checkin_date = $request->checkin_date;
//        $reservation->checkout_date = $request->checkout_date;
//        $reservation->save();

        return redirect("/user/reservation-payment")->with('reservation', $request->all());
    }

    public function reservationPayment(Request $request)
    {
        $reservation = cache()->get('reservation');

        if (!$reservation) {
            return redirect()->back()->withErrors('Rezervasyon bilgileri bulunamadı.');
        }
        $cards = CreditCart::where('user_id', Auth::id())->get();
        return view('reservation_payment',compact('cards'))->with('reservation', $reservation);

    }

    public function reservationPaymentCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_name' => 'required',
            'card_number' => 'required',
            'card_month' => 'required',
            'card_year' => 'required',
            'card_cvc' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $reservation = cache()->get('reservation');
        if (!$reservation) {
            return redirect()->back()->withErrors('Rezervasyon bilgileri bulunamadı.');
        }
        //if cart number is finish with 1111 not accept
        if (substr($request->card_number, -4) == '1111') {
            return redirect()->back()->withErrors('Kartinizda yeterli bakiye bulunmamaktadir.');
        }
        $reservationDB = new Reservation();
        $reservationDB->user_id = Auth::id();
        $reservationDB->detail_id = $reservation['detailId'];
        $reservationDB->hotel_id = $reservation['hotel_id'];
        $reservationDB->hotel_name = $reservation['hotel_name'];
        $reservationDB->hotel_price = $reservation['hotel_price'];
        $reservationDB->person_count = $reservation['person_count'];
        $reservationDB->phone = $reservation['phone'];
        $reservationDB->checkin_date = $reservation['checkin_date'];
        $reservationDB->checkout_date = $reservation['checkout_date'];
        $reservationDB->save();

        cache()->forget('reservation');

        return redirect("/user/profile/reservations")->with('success', 'Rezervasyonunuz başarıyla oluşturuldu.');
    }

    public function getUserReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return view('user_reservations', compact('reservations'));
    }

    public function getReservationDetail($id)
    {
        $details = HotelDetails::where('hotel_id', $id)->get();
        return view('reservation_detail', compact('details'));
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function getCreditCarts()
    {
        $user = Auth::user();
        $cards = CreditCart::where('user_id', $user->id)->get();
        foreach ($cards as $card) {
            $card->card_number = substr_replace($card->card_number, '**** **** **** ', 0, 15);
        }
        return view('credit_carts', compact('cards'));
    }

    public function addCreditCarts() {
        return view('add_credit_carts');
    }

    public function storeCreditCarts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_name' => 'required',
            'card_number' => 'required',
            'card_month' => 'required',
            'card_year' => 'required',
            'card_cvc' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $expiration_date = date('m/Y', strtotime($request->card_year . '-' . $request->card_month ));
        $card = new CreditCart();
        $card->user_id = Auth::id();
        $card->name = $request->card_name;
        $card->card_number = $request->card_number;
        $card->expiration_date = $expiration_date;
        $card->cvc = $request->card_cvc;
        $card->save();

        return redirect('/user/profile/credit-carts')->with('success', 'Kredi kartınız başarıyla eklendi.');
    }
}
