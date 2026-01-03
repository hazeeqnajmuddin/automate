<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'accident_histories';

    /**
     * The primary key associated with the table.
     * Based on migration: $table->id('AnD_id');
     */
    protected $primaryKey = 'AnD_id';

    /**
     * The attributes that are mass assignable.
     * These match the field names used in the Canvas view.
     */
    protected $fillable = [
        'car_id',
        'AnD_date',
        'AnD_type',
        'AnD_location',
        'AnD_description',
    ];

    /**
     * The attributes that should be cast.
     * Casting 'AnD_date' to a date allows the Canvas to format 
     * it using Carbon (e.g., ->format('M')).
     */
    protected $casts = [
        'AnD_date' => 'date',
    ];

    /**
     * Get the car that owns the accident record.
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}