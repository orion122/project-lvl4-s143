@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Users</h1>
        <table class="table table-striped ">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    {{--<td><a href="domains/{{ $item->id }}">{{ $item->name }}</a></td>--}}
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection