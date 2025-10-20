<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accident_histories', function (Blueprint $table) {
            $table->id('AnD_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->date('AnD_date');
            $table->string('AnD_type');
            $table->string('AnD_location')->nullable();
            $table->text('AnD_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accident_histories');
    }
};
