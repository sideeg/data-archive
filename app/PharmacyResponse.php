<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyResponse extends Model
{
    protected $fillable =
    [
        'pharmacy_id',
        'order_id',
        'medicine_id',
        'price'
    ];
}
