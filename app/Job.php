<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // protected $with = ['employee'];
    protected $fillable =
    [
        'name',
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
