@extends('layout')

@section('content')
    <div class="border-bottom mb-3 pb-3">
        <h1>{{ $project->name }}</h1>
        <textarea cols="30" rows="10" class="form-control">{{ $project->description }}</textarea>
    </div>
    <form method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-outline-danger float-end">Delete</button>
    </form>
@endsection