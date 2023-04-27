<?php

namespace App\Models;

class Product extends CoreModel
{
    protected $table = 'products';

    protected $fillable =[
        'name',
        'image',
        'price'
    ];
}
