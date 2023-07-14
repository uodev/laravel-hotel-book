<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'hotel_id' => 'required|integer',
            'user_id' => 'required|integer',
            'hotel_name' => 'required',
            'hotel_price' => 'required',
            'person_count' => 'required',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date',
            'phone' => 'required',
            'detail_id' => 'required',
            'status' => 'required|default:0|integer|min:0|max:2',
        ];
    }
}
