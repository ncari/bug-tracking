@extends('layout')

@section('content')
    <div class="mb-3">
        <h1><a href="/projects/{{$project->id}}">{{ $project->name }}</a></h1>
    </div>
    <div class="mb-3">
        <h2>Ticket: {{ $ticket->name }}</h2>
        <textarea class="form-control">{{ $ticket->description }}</textarea>
    </div>
    <div class="mb-3 pb-3 border-bottom">
        <h3>Comments</h3>
        @foreach ($ticket->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    {{ $comment->text }}
                </div>
            </div>
        @endforeach
        <form action="/tickets/{{$ticket->id}}/comments" method="POST">
            @csrf
            <div class="mb-3">
                <label for="text">Comment</label>
                <textarea name="text" id="text" name="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div>
        <form action="/tickets/{{$ticket->id}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection