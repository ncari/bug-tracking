@extends('layout')

@section('content')
    <div class="border-bottom mb-3 pb-3">
        <h1>{{ $project->name }}</h1>
        <div class="card">
            <div class="card-body">
                <span style="white-space: pre-line">{{$project->description}}</span>
            </div>
        </div>
        <div class="mt-3">
            <h2>Tickets</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($project->tickets as $ticket)
                        <tr>
                            <th scope="row"><a href="/tickets/{{$ticket->id}}">{{ $ticket->id }}</a></th>
                            <td>{{ $ticket->name }}</td>
                            <td>{{ $ticket->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
        <div class="mt-5">
            <h4>New Ticket</h4>
            <form action="/projects/{{$project->id}}/tickets" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control form-control-sm">
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" name="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Ticket</button>
            </form>
        </div>
    </div>
    <div class="p-3 bg-light">
        <h2>Settings</h2>
        <form method="post">
            @method('DELETE')
            @csrf
            <button type="submit" id="delete" class="btn btn-outline-danger btn-sm">Delete Project</button>
        </form>
    </div>
@endsection