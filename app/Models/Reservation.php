<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function Room()
    {
        return $this->belongsTo(HotelDetails::class, 'detail_id', 'id');
    }
}
