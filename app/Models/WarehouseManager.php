<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_number',
        'phone',
    ];

    // Mối quan hệ với User (1 Warehouse Manager là 1 User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
