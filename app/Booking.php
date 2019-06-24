<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['client_id', 'car_id', 'booking_code', 'order_date', 'duration', 'return_date_supposed', 'return_date', 'fine', 'total_price'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

    
}
