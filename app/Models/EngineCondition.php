<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineCondition extends Model
{
    use HasFactory;

    protected $primaryKey = 'car_id';
    public $incrementing = false;

    protected $fillable = [
        'car_id',
        'engine_size',
        'engine_noise',
        'engine_light',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}