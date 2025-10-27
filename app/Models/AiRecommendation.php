<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiRecommendation extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'recommendation_id';

    /**
     * The attributes that are mass assignable.
     * These should match the columns in your 'ai_recommendations' table migration.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'recommended_service',
        'recommendation_date',
        'confidence_score',
        'importance_score',
        'cost_estimation',
    ];

    /**
     * Get the car that this recommendation belongs to.
     * Defines the inverse of the one-to-many relationship.
     */
    public function car()
    {
        // A recommendation belongs to a car.
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}
