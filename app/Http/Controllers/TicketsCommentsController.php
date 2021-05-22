<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Ticket;

class TicketsCommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ticket $ticket)
    {
        if(Auth::user()->cannot('view', $ticket->project))
            abort(403);
        else if($ticket->project->archived || $ticket->status === "ARCHIVED")
            abort(403);

        $comment = new Comment($request->all());
        $ticket->comments()->save($comment);
        return back();
    }
}
