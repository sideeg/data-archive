<?php

namespace App;

use App\Medication;
use Illuminate\Database\Eloquent\Model;

class MedicationStatus extends Model
{
    protected $fillable = 
    [
        'medicine_status',
    ];

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }
}
