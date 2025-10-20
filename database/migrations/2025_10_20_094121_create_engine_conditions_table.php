<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engine_conditions', function (Blueprint $table) {
            $table->id('engine_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->boolean('engine_light')->default(false);
            $table->string('engine_noise')->nullable();
            $table->string('engine_size');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engine_conditions');
    }
};
