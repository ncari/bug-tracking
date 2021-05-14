<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class ProjectsUsersController extends Controller
{
    public function addUsersToProject(Request $request, Project $project){
        if(Auth::user()->cannot('updateCollaborators', $project)){
            abort(403);
        }

        $usersIds = $request->input('users');
        $project->collaborators()->attach($usersIds);
        return back();
    }

    public function removeUsersFromProject(Request $request, Project $project){
        if(Auth::user()->cannot('updateCollaborators', $project)){
            abort(403);
        }

        $usersIds = $request->input('users');
        $project->collaborators()->detach($usersIds);
        return back();
    }
}
