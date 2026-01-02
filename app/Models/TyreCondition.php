<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TyreCondition extends Model
{
    use HasFactory;
    protected $primaryKey = 'car_id';
    public $incrementing = false;

    protected $fillable = [
        'car_id',
        'tyre_tread',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}