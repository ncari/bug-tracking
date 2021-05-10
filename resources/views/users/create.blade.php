@extends('layout')


@section('content')
    <h1>Users</h1>
    <div class="card">
        <div class="card-header">
            Create User
        </div>
        <div class="card-body">
            <form action="/users" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="" selected>Choose One</option>
                        <option value="DEV">Dev</option>
                        <option value="PM">Project Manager</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection