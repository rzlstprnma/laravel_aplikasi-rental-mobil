<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand_id', 'car_name', 'plat_number', 'price', 'type', 'available', 'photo'];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function getPhoto(){
        return asset('/images/car_images/'. $this->photo);
    }
}
