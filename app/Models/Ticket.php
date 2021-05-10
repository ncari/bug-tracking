<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Project;
use App\Models\Comment;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    protected $table = 'tickets';
}
