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
                    <td><a href="{{ route('tasks.show', $task->id) }}" >{{ $task->name }}</a></td>
                    <td>{{ $task->taskStatus->name }}</td>
                    <td><a href="{{ route('users.show', $task->owner->id) }}">{{ $task->owner->name }}</a></td>
                    <td><a href="{{ route('users.show', $task->assigned->id) }}">{{ $task->assigned->name }}</a></td>
                    <td>{{ $task->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </div>
@endsection