<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ticket;

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

    protected $table = 'projects';
}
