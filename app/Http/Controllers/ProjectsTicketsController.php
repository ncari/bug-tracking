<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
        $ticket = new Ticket($request->all());
        $project->tickets()->save($ticket);
        return redirect('/projects'.'/'.$project->id);
    }
}
