<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_name',
        'license_plate',
        'image',
        'rental_price',
        'status',
    ];

    // Mối quan hệ với VehicleBorrowing (1 Vehicle có nhiều VehicleBorrowing)
    public function borrowings()
    {
        return $this->hasMany(VehicleBorrowing::class);
    }

    // Trả về đường dẫn đầy đủ của hình ảnh
    public function getImageUrlAttribute()
    {
        return asset('assets/images/' . $this->image);
    }

    // Trả về giá thuê theo định dạng tiền tệ
    public function getFormattedRentalPriceAttribute()
    {
        return number_format($this->rental_price, 2);
    }
}
