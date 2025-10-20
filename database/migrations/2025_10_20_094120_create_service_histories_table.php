<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_histories', function (Blueprint $table) {
            $table->id('service_id');
            // MODIFIED: Explicitly reference the 'car_id' column
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->date('service_date');
            $table->string('service_type');
            $table->string('service_location')->nullable();
            $table->text('service_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_histories');
    }
};

