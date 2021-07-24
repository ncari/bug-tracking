<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ticket;
use App\Models\User;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'archived'
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function collaborators(){
        return $this->belongsToMany(User::class, 'projects_users', 'project_id', 'user_id');
    }

    public function subscribers(){
        return $this->belongsToMany(User::class, 'subscriptions');
    }

    protected $table = 'projects';
}
