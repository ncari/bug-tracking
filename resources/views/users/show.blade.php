@extends('layout')

@section('content')
    <div class="pb-3 mb-3 border-bottom">
        <h1>{{ $user->name }}</h1>
        <form action="/users/{{$user->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="" selected>Choose One</option>
                    <option value="DEV" @if($user->type == "DEV") selected @endif>Dev</option>
                    <option value="PM" @if($user->type == "PM") selected @endif>Project Manager</option>
                    <option value="ADMIN" @if($user->type == "ADMIN") selected @endif>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="p-3 bg-light">
        <h2>Settings</h2>
        <form action="/users/{{$user->id}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete Account</button>
        </form>
    </div>

@endsection