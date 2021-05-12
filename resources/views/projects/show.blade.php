@extends('layout')

@section('content')
    <div class="border-bottom mb-3 pb-3">
        <div class="d-flex align-items-center">
            <i data-feather="box"></i>
            <h1 class="fw-bold">{{ $project->name }}</h1>
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
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Replies</th>
                        <th scope="col">Last Reply</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($project->tickets as $ticket)
                            <tr>
                                <th scope="row"><a href="/tickets/{{$ticket->id}}">{{ $ticket->id }}</a></th>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->description }}</td>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-alert-empty>
        </div>
        <div class="mt-4 shadow p-3">
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

    <x-danger-zone formUrl="/projects/{{$project->id}}" name="Project"/>
@endsection