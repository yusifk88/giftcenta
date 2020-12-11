<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualCard extends Model
{
    protected $table = 'virtual_card';
    protected $fillable=[
        'billing_name','amount','sendername','senderemail','message','recipientname','recipientemail',
        'number','expiry_date','vendor_name','cvv','created','currency','number','expiry_date','vendor_name','cvv','masked_number'
    ];

}
