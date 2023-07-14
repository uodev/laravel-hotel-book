<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'star' => 'required|integer|min:1|max:5',
            'image' => 'required',
            'phone' => 'required|string|min:10|max:11',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'city' => 'required',
        ];
    }
}
