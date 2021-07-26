<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

use App\Mail\TicketCreated as TicketCreatedEmail;

class SendTicketCreatedEmail
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        $subscribers = $event->ticket->project->subscribers;
        foreach($subscribers as $subscriber){
            Mail::to($subscriber)->send(new TicketCreatedEmail());
        }
    }
}
