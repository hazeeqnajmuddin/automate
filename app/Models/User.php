<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Table primary key (since your column is 'user_id' instead of 'id')
     */
    protected $primaryKey = 'user_id';

    /**
     * If the key is auto-incrementing and integer type
     */
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'full_name',
        'user_email',
        'username',
        'password',
        'user_role',
        'profile_pic_path',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
