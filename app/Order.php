<?php

namespace App;

use App\User;
use App\Employee;
use App\Medication;
use App\OrderStatus;
use App\DeliveryTime;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $with = ['orderStatus', 'users', 'deliveryTime', 'deliveryOfficer'];
    
    protected $fillable = 
    [
        'pation_name',
        'phone',
        'prescription_photo',
        'medicine_name',
        'insurance_card_photo',
        'insurance',
        'order_price',
        'user_id',
        'order_status_id',
        'medication_id',
        'delivery_time_id',
        'employee_id',
        'location_description',
        'another_phone'
    ];


    protected $appends = ['prescription_photo_full_path','insurance_card_photo_full_path'];

	public function getPrescriptionPhotoFullPathAttribute()
	{
		return isset($this->attributes['prescription_photo']) ?  '/images/' . $this->attributes['prescription_photo'] : null;
    }
    
    public function getInsuranceCardPhotoFullPathAttribute()
	{
		return isset($this->attributes['insurance_card_photo']) ? '/images/' . $this->attributes['insurance_card_photo'] : null;
    }


    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function orderStatus()
    {
        
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function medication()
    {
        return $this->hasMany(Medication::class);
    }


    public function deliveryTime()
    {
        return $this->belongsTo(DeliveryTime::class, 'delivery_time_id');
    }

    public function deliveryOfficer()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }







}