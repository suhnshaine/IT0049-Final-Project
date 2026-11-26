<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'full_name',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password'
    ];

    public function sales()
    {
        return $this->hasMany(
            Sale::class,
            'sold_by'
        );
    }
}
