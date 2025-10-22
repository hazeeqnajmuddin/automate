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

    /**
     * Get the cars associated with the user.
     * Defines the one-to-many relationship.
     */
    public function cars()
    {
        // A user has many cars. We need to specify the foreign key ('user_id')
        // and the local key ('user_id' on this users table) because they are non-standard.
        return $this->hasMany(Car::class, 'user_id', 'user_id');
    }
}
