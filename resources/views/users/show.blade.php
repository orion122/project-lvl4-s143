@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Users</h1>
        <table class="table table-striped ">
            <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
