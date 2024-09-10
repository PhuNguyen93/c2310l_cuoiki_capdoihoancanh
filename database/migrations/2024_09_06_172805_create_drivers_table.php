<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('driver_license_number')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
