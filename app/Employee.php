<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{

    use Notifiable, HasRoles;
     
    protected $guard = 'employee';

    protected $with = ['job'];

    protected $fillable = 
    [
        'name',
        'password',
        'phone',
        'email',
        'identification_number',
        'job_id',
    ];

    protected $hidden = ['password'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
