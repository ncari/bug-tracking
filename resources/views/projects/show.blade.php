@extends('layout')

@section('content')
    <div class="row border-bottom ">
        <div class="col-8">
            <div class="mb-3 pb-3">
                <div class="d-flex align-items-center">
                    <h1 class="fw-bold">
                        {{ $project->name }}
                    </h1>
                    @if ($project->archived)
                        <span class="badge bg-secondary">Archived</span>    
                    @else
                        <span class="badge bg-success">Active</span>    
                    @endif
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <span style="white-space: pre-line">{{$project->description}}</span>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="d-flex align-items-center">
                        <i data-feather="flag"></i>
                        <h2>Tickets</h2>
                    </div>
                    <x-alert-empty name="tickets" :n="$project->tickets->count()">
                        <table class="table table-light table-striped shadow border">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Replies</th>
                                <th scope="col">Last Reply</th>
                                <th scope="col">Status</th>
                                <th scope="col">Priority</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($project->tickets as $ticket)
                                    <tr>
                                        <td><a href="/tickets/{{$ticket->id}}">{{ $ticket->name }}</a></td>
                                        <td>{{ $ticket->comments->count()}}</td>
                                        <td>
                                            @php
                                                $lastComment = $ticket->comments()->orderByDesc('updated_at')->first();
                                            @endphp
                                            @if($lastComment !== null)
                                                {{ $lastComment->updated_at->diffForHumans() }}    
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $ticket->status }}</td>
                                        <td>{{ $ticket->priority }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-alert-empty>
                </div>
                <div class="mt-4 shadow p-3">
                    <h4>New Ticket</h4>
                    <form action="/projects/{{$project->id}}/tickets" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" class="form-select" required>
                                <option value="" selected>Choose One</option>
                                <option value="L">Low</option>
                                <option value="M">Medium</option>
                                <option value="H">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" name="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" accept="image/jpg" class="form-control" /> 
                        </div>
                        <button type="submit" class="btn btn-primary">Add Ticket</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">

        </div>
    </div>
    <div class="row">
        <x-danger-zone formUrl="/projects/{{$project->id}}" name="Project">
            <form class="mb-3" action="/projects/{{$project->id}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="archived" value=@if($project->archived) 0 @else 1 @endif>
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    @if ($project->archived)
                        Active Project
                    @else
                        Archive Project
                    @endif
                </button>
            </form>
            <div class="mb-3">
                <form action="/projects/{{$project->id}}/users" method="post">
                    <input type="hidden" id="collaborators" value="{{ $project->collaborators->toJson() }}">
                    @csrf
                    @method('DELETE')
                    <div id="removeCollaboratorsForm">

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Remove Collaborators</button>
                </form>
            </div>
            <div class="mb-3">
                <input id="users" type="hidden" value="{{ $users->toJson() }}"/>
                <form action="/projects/{{$project->id}}/users" method="post">
                    @csrf
                    <div id="addCollaboratorsForm"">

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Add Collaborators</button>
                </form>
            </div>
        </x-danger-zone>
    </div>
@endsection