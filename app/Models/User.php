<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

use App\Models\Project;

class User extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected static function booted()
    {
        static::creating(function ($user) {
            $password = $user->password;
            $user->password = Hash::make($password);
        });
    }

    public function projects(){
        return $this->belongsToMany(Project::class, 'projects_users', 'user_id', 'project_id');
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
