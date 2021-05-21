<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'project' => $ticket->project
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
        if(Auth::user()->cannot('view', $ticket->project))
            abort(403);

        $ticket->update($request->all());
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

        $ticket->delete();
        return redirect('/projects'.'/'.$ticket->project->id);
    }
}
