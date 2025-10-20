<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_recommendations', function (Blueprint $table) {
            $table->id('recommendation_id');
            $table->foreignId('car_id')->constrained('cars', 'car_id')->onDelete('cascade');
            $table->string('recommended_service');
            $table->date('recommendation_date');
            $table->decimal('confidence_score', 5, 2);
            $table->integer('importance_score');
            $table->decimal('cost_estimation', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_recommendations');
    }
};
