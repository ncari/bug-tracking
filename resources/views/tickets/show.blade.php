@extends('layout')

@section('content')
    <div class="mb-3">
        Project: <a href="/projects/{{$project->id}}">{{ $project->name }}</a>
    </div>
    <div class="mb-3">
        <h1>Ticket: {{ $ticket->name }}</h1>
        <div class="card mb-2">
            <div class="card-body">
                <span style="white-space: pre-line">{{ $ticket->description }}</span>
            </div>
        </div>
    </div>
    <div class="mb-3 pb-3 border-bottom">
        <h3>Comments</h3>
        @foreach ($ticket->comments as $comment)
            <div class="card mb-2">
                <div class="card-header">
                    {{ $comment->created_at->diffForHumans()}}
                </div>
                <div class="card-body">
                    <span style="white-space: pre-line">{{ $comment->text }}</span>
                </div>
            </div>
        @endforeach
        <div class="mt-3">
            <form action="/tickets/{{$ticket->id}}/comments" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="text">New comment...</label>
                    <textarea name="text" id="text" name="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
        </div>
    </div>
    <div class="p-3 bg-light">
        <h2>Settings</h2>
        <form action="/tickets/{{$ticket->id}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete Ticket</button>
        </form>
    </div>
@endsection