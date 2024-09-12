<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'driver_license_number',
        'phone',
    ];

    // Mối quan hệ với User (1 Driver là 1 User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ với VehicleBorrowing (1 Driver có thể mượn nhiều Vehicle)
    public function borrowings()
    {
        return $this->hasMany(VehicleBorrowing::class);
    }
}
