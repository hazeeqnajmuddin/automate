<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'car_id';

    /**
     * The attributes that are mass assignable.
     * These should match the columns in your 'cars' table migration.
     *
     * @var array<int, string>
     */
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
    ];

    /**
     * Get the user that owns the car.
     * Defines the inverse of the one-to-many relationship.
     */
    public function user()
    {
        // A car belongs to a user. We need to specify the foreign key ('user_id')
        // and the owner key ('user_id' on the users table) because they are non-standard.
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
