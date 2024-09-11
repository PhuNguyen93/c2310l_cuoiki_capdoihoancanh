<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBorrowing extends Model
{
    use HasFactory;

    protected $table = 'vehicle_borrowings';

    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'borrow_date',
        'return_date',
        'status'
    ];

    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    // Model VehicleBorrowing.php
    protected $guarded = ['vehicle_id', 'driver_id', 'borrow_date', 'return_date', 'status'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

}

