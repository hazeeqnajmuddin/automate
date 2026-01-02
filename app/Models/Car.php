<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $primaryKey = 'car_id';

    protected $fillable = [
        'user_id',
        'model',
        'brand',
        'registered_year',
        'transmission_type',
        'age',
        'fuel_type',
        'mileage',
        'battery_light_on',
        'license_plate',
        'car_image_path',
    ];

    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * RELATIONSHIPS FOR DIAGNOSTICS (Feature Set for DT)
     */

    public function engineCondition(): HasOne
    {
        return $this->hasOne(EngineCondition::class, 'car_id', 'car_id');
    }

    public function brakeCondition(): HasOne
    {
        return $this->hasOne(BrakeCondition::class, 'car_id', 'car_id');
    }

    public function tyreCondition(): HasOne
    {
        return $this->hasOne(TyreCondition::class, 'car_id', 'car_id');
    }

    /**
     * RELATIONSHIPS FOR OUTPUTS
     */

    public function aiRecommendations(): HasMany
    {
        return $this->hasMany(AIRecommendation::class, 'car_id', 'car_id');
    }

    public function serviceHistories(): HasMany
    {
        return $this->hasMany(ServiceHistory::class, 'car_id', 'car_id');
    }
}