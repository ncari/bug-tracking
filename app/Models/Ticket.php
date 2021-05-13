<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Models\Project;
use App\Models\Comment;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'status',
        'priority',
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


    public function image64(){
        if($this->image_path)
            return \base64_encode(Storage::get($this->image_path));
        return null;
            
    }

    protected $table = 'tickets';
}
