@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Tasks</h1>
        <table class="table table-striped ">
            <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Creator Name</th>
                <th>Assigned To</th>
                <th>Tags</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->taskStatus->name }}</td>
                    <td><a href="{{ route('users.show', $task->owner->id) }}">{{ $task->owner->name }}</a></td>
                    <td><a href="{{ route('users.show', $task->assigned->id) }}">{{ $task->assigned->name }}</a></td>
                    <td>{{ implode(', ', $task->tags->pluck('name')->all()) }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->updated_at }}</td>
                </tr>
            </tbody>
        </table>
        <a class="btn btn-block btn-primary" href="{{ route('tasks.edit', $task) }}">Edit Task</a>
    </div>
@endsection