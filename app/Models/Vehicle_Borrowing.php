<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBorrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    // Mối quan hệ với Vehicle (1 lần mượn thuộc về 1 Vehicle)
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Mối quan hệ với Driver (1 lần mượn thuộc về 1 Driver)
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
