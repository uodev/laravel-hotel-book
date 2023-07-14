<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    //soft delete
    use SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'star',
        'image',
        'phone',
        'email',
        'password',
        'city',
    ];
    public function hotelDetails() {
        return $this->belongsTo(HotelDetails::class);
    }

}
