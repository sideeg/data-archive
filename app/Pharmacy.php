<?php

namespace App;

use App\Medication;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    // protected $with = ['medication'];
    protected $fillable = 
    [
        'name',
        'owner',
        'phone',
        'password',
        'license_number',
        'long',
        'lat',
        'insurance',
    ];

    public function medication()
    {
        return $this->hasMany(Medication::class);
    }
}

