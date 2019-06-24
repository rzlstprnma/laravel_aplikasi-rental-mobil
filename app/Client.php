<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nik', 'name', 'gender', 'date_of_birth', 'phone', 'address', 'slug'];

}
