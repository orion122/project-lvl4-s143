@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Tasks</h1>
        <table class="table table-striped ">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Assigned To</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $key => $task)
                <tr>
                    <th scope="row">{{ $tasks->firstItem() + $key }}</th>
                    {{--<td><a href="domains/{{ $item->id }}">{{ $item->name }}</a></td>--}}
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->taskStatus }}</td>
                    <td>{{ $task->creator }}</td>
                    <td>{{ $task->assignedTo }}</td>
                    <td>{{ $task->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </div>
@endsection