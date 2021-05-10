@extends('layout')


@section('content')
    <h1>Projects</h1>
    <div class="card">
        <div class="card-header">
            Create Project
        </div>
        <div class="card-body">
            <form action="/projects" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" name="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection