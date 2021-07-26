<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Ticket;
use App\Models\TicketHistory;

class TicketsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if(Auth::user()->cannot('view', $ticket->project))
            abort(403);

        return view('tickets.show', [
            'ticket' => $ticket,
            'ticket_image' => $ticket->image64(),
            'project' => $ticket->project,
            'tickets_history' => TicketHistory::where('ticket_id', $ticket->id)
                                                ->orderByDesc('created_at')
                                                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        if (! Gate::allows('update-ticket', $ticket)) {
            abort(403);
        }

        $originals = $ticket->getOriginal();

        $ticket->update($request->all());

        TicketHistory::updateHistory($ticket, $originals, Auth::user()->id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if(Auth::user()->cannot('view', $ticket->project))
            abort(403);
        else if($ticket->project->archived || $ticket->status === "ARCHIVED")
            abort(403);

        $ticket->delete();
        return redirect('/projects'.'/'.$ticket->project->id);
    }
}
