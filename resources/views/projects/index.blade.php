@extends('layout')


@section('content')
    <h1>Projects</h1>
    <x-alert-empty name="projects" :n="$projects->count()">
      <table class="table table-light table-striped shadow border">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Tickets</th>
            <th scope="col">Last Ticket</th>
            <th scope="col">Active</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td><a href="/projects/{{$project->id}}">{{ $project->name }}</a></td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->tickets->count() }}</td>
                    <td>
                      @php
                          $lastTicket = $project->tickets()->orderByDesc('updated_at')->first();
                      @endphp
                      @if($lastTicket !== null)
                          {{ $lastTicket->updated_at->diffForHumans() }}    
                      @else
                          -
                      @endif
                    </td>
                    <td>
                      @if($project->archived) 
                        <i data-feather="x"></i>
                      @else  
                        <i data-feather="check"></i>
                      @endif
                    </td>
              </tr>
            @endforeach
        </tbody>
        
      </table>
    </x-alert-empty>
    
        

@endsection