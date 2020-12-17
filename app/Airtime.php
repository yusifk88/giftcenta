<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    protected $table='airtimes';
    protected $fillable=['phone_number','country','network','amount','recipient_email','sender_email','sender_name','message','paid'];
}
