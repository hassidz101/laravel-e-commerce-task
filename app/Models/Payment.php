<?php

namespace App\Models;

class Payment extends CoreModel
{
    protected $table = 'payments';

    protected $fillable =[
        'order_id',
        'charge_id',
        'status'
    ];
}
