<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->password = md5($user->password);
        });
    }

    protected $hidden = ['password'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    protected $table = 'users';
}
