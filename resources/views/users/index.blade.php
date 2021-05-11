@extends('layout')

@section('content')
    <h1>Users</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row"><a href="/users/{{$user->id}}">{{ $user->id }}</a></th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
              </tr>
            @endforeach
        </tbody>
        
      </table>
@endsection