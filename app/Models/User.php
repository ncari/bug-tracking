<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

use App\Models\Project;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasFactory;
    use Authenticatable;
    use Authorizable;

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

    public function isAdmin(){
        return $this->type === 'ADMIN';
    }

    public function isPM(){
        return $this->type === 'PM';
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
