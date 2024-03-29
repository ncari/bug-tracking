@extends('layout')

@section('content')
    <div class="row border-bottom">
        <div class="col-8">
            <div class="mb-3">
                Project: <a href="/projects/{{$project->id}}">{{ $project->name }}</a>
            </div>
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <h1>{{ $ticket->name }}</h1>
                    @if ($ticket->status === "ARCHIVED")
                        <span class="badge bg-secondary">Archived</span>    
                    @else
                        @if ($ticket->status === "CLOSED")
                            <span class="badge bg-danger">Closed</span>    
                        @else
                            <span class="badge bg-success">Open</span>    
                        @endif
                    @endif
                </div>
                <h6 class="mb-3">
                    Priority: 
                    @if ($ticket->priority === "L")
                    <div class="badge bg-light text-dark">Low</div>    
                    @else
                        @if ($ticket->priority === "M")
                            <div class="badge bg-warning">Medium</div> 
                        @else
                            <span class="badge bg-danger">High</span>    
                        @endif
                    @endif
                </h6>
                <div class="card mb-2 shadow-sm">
                    <div class="card-body">
                        @if ($ticket_image !== null)
                            <div class="mb-3">
                                <span style="white-space: pre-line">{{ $ticket->description }}</span>    
                            </div>
                            <img src="data:image/jpeg;base64,{{$ticket_image}}" style="max-width: 100%"/>    
                        @else
                            <span style="white-space: pre-line">{{ $ticket->description }}</span>
                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="mt-5 mb-3 pb-3">
                <div class="d-flex align-items-center">
                    <i data-feather="message-square"></i>
                    <h3>Comments</h1>
                </div>
                <x-alert-empty name="comments" :n="$ticket->comments->count()">
                    @foreach ($ticket->comments as $comment)
                        <div class="card mb-2 shadow-sm">
                            <div class="card-header">
                                {{ $comment->created_at->diffForHumans()}}
                            </div>
                            <div class="card-body">
                                <span style="white-space: pre-line">{{ $comment->text }}</span>
                            </div>
                        </div>
                    @endforeach
                </x-alert-empty>
                @if ($ticket->status !== 'ARCHIVED' && !$ticket->project->archived)
                    <div class="mt-3 shadow p-3">
                        <form action="/tickets/{{$ticket->id}}/comments" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="text">New comment...</label>
                                <textarea name="text" id="text" name="description" cols="30" rows="5" class="form-control form-control-sm"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>    
                @endif
            </div>
        </div>
        <div class="col-4">
            @if (count($tickets_history) > 0)
                <h5 class="mt-5">Ticket History</h5>
                <ul>
                    @foreach ($tickets_history as $ticket_history)
                        <li>
                            <a href="/users/{{$ticket_history->user->id}}">{{$ticket_history->user->name}}</a> has change {{$ticket_history->attribute_name}} 
                            from {{$ticket_history->attribute_previous_value}} 
                            to {{$ticket_history->attribute_actual_value}} 
                            {{$ticket_history->created_at->diffForHumans()}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    @can('update-ticket', $ticket)
        <div class="row">
            <x-danger-zone formUrl="/tickets/{{$ticket->id}}" name="Ticket">
                <form class="mb-5" action="/tickets/{{$ticket->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="OPEN" @if($ticket->status == "OPEN") selected @endif>Open</option>
                            <option value="CLOSED" @if($ticket->status == "CLOSED") selected @endif>Closed</option>
                            <option value="ARCHIVED" @if($ticket->status == "ARCHIVED") selected @endif>Archived</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" class="form-select" required>
                            <option value="L" @if($ticket->priority == "L") selected @endif>Low</option>
                            <option value="M" @if($ticket->priority == "M") selected @endif>Medium</option>
                            <option value="H" @if($ticket->priority == "H") selected @endif>High</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>            
                </form>
            </x-danger-zone>
        </div>    
    @endcan
@endsection