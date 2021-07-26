<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ticket;
use App\Models\User;

class TicketHistory extends Model
{
    use HasFactory;

    private static $non_traceable = ['updated_at', 'created_at'];

    public static function updateHistory(Ticket $ticket, array $originals, $user_id){
        $changes = $ticket->getChanges();

        foreach($changes as $key => $value)
            if(!in_array($key, TicketHistory::$non_traceable)){
                TicketHistory::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user_id,
                    'attribute_name' => $key,
                    'attribute_previous_value' => $originals[$key],
                    'attribute_actual_value'=> $value
                ]);
            }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $guarded = []; 

    protected $table = 'tickets_history';
}
