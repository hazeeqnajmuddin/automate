<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brake_conditions', function (Blueprint $table) {
            $table->id('brake_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->string('brake_effectiveness');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brake_conditions');
    }
};
