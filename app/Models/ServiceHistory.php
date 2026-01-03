<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     * Based on your migration: $table->id('service_id');
     */
    protected $primaryKey = 'service_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'car_id',
        'service_date',
        'service_type',
        'service_location',
        'service_description',
    ];

    /**
     * The attributes that should be cast.
     * Casting 'service_date' to a date object allows us to use Carbon 
     * methods like ->format() or ->diffForHumans() easily in the view.
     */
    protected $casts = [
        'service_date' => 'date',
    ];

    /**
     * Get the car that owns the service history record.
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}