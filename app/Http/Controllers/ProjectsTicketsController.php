<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;

class ProjectsTicketsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        if(Auth::user()->cannot('addTicket', $project)){
            abort(403);
        }
        
        $path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('tickets_images');
            if(!$path)
                return back()->withErrors('ticket_image', 'There was an error uploading the image');
        }
    
        $ticket = new Ticket($request->all());
        $ticket->image_path = $path;
        
        $project->tickets()->save($ticket);
        return redirect('/projects'.'/'.$project->id);
    }
}
