<?php

namespace App;

use App\Order;
use App\MedicationStatus;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $with = ['order', 'medicineStatus'];

    protected $fillable =  
    [
        'name',
        'effective_material',
        'company_name',
        'license_number',
        'price',
        'order_id',
        'medication_status_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function medicineStatus()
    {
        return $this->belongsTo(MedicationStatus::class, 'medication_status_id');
    }

}