<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('model');
            $table->string('brand');
            $table->year('registered_year');
            $table->string('transmission_type');
            $table->integer('age');
            $table->string('fuel_type');
            $table->integer('mileage');
            $table->boolean('battery_light_on')->default(false);
            $table->string('license_plate')->unique();
            $table->string('car_image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

