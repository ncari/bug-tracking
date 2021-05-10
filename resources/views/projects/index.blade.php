@extends('layout')


@section('content')
    <h1>Projects</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row"><a href="/projects/{{$project->id}}">{{ $project->id }}</a></th>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
              </tr>
            @endforeach
        </tbody>
        
      </table>
    
        

@endsection