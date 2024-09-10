<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVehicleBorrowingsTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->timestamp('borrow_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('return_date')->nullable();
            $table->enum('status', ['Borrowed', 'Returned'])->default('Borrowed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_borrowings');
    }
}
