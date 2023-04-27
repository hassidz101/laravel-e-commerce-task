<?php

namespace App\Models;

class Order extends CoreModel
{
    protected $table = 'orders';

    protected $fillable =[
        'email',
        'product_id'
    ];
}
