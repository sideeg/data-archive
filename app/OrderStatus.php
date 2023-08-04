<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = 
    [
        'order_status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
