<?php

namespace App\Http\Resources;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        return [
                'id' => $this->id,
                'user' => $user,
                'hotel_name' => $this->hotel_name,
                'hotel_price' => $this->hotel_price,
                'person_count' => $this->person_count,
                'checkin_date' => $this->checkin_date,
                'checkout_date' => $this->checkout_date,
                'phone' => $this->phone,
                'detail_id' => $this->detail_id,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
        ];
    }
}
