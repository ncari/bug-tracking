@extends('layout')

@section('content')
    <h1>Users</h1>
    <x-alert-empty name="users" :n="$users->count()">
      <table class="table table-light table-striped shadow border">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="/users/{{$user->id}}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->type }}</td>
              </tr>
            @endforeach
        </tbody>
        
      </table>
    </x-alert-empty>
@endsection