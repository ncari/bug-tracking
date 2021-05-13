<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class ProjectsUsersController extends Controller
{
    public function addUsersToProject(Request $request, Project $project){
        $usersIds = $request->input('users');
        $project->collaborators()->attach($usersIds);
        return back();
    }

    public function removeUsersFromProject(Request $request, Project $project){
        $usersIds = $request->input('users');
        $project->collaborators()->detach($usersIds);
        return back();
    }
}
