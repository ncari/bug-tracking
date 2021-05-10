@extends('layout')

@section('content')
    <div class="mb-3">
        <h1><a href="/projects/{{$project->id}}">{{ $project->name }}</a></h1>
    </div>
    <div class="mb-3">
        <h2>Ticket: {{ $ticket->name }}</h2>
        <textarea class="form-control">{{ $ticket->description }}</textarea>
    </div>
    <div>
        <form action="/tickets/{{$ticket->id}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection