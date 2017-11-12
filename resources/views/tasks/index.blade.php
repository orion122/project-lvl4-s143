@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Tasks</h1>
        <form class="" method="GET" action="{{ route('tasks.index') }}">
        <table class="table table-striped ">

            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Assigned To</th>
                <th>Tags</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $key => $task)
                <tr>
                    <th scope="row">{{ $tasks->firstItem() + $key }}</th>
                    <td><a href="{{ route('tasks.show', $task->id) }}" >{{ $task->name }}</a></td>
                    <td>{{ $task->taskStatus->name }}</td>
                    <td><a href="{{ route('users.show', $task->owner->id) }}">{{ $task->owner->name }} ({{ $task->owner->email }})</a></td>
                    <td><a href="{{ route('users.show', $task->assigned->id) }}">{{ $task->assigned->name }} ({{ $task->assigned->email }})</a></td>
                    <td>{{ implode(', ', $task->tags->pluck('name')->all()) }}</td>
                    <td>{{ $task->created_at }}</td>
                </tr>
            @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <select name="status" class="form-control">
                            <option></option>
                            @foreach($statuses as $key => $status)
                                <option value="{{ $status->id }}"
                                        @if ($status->id == Request::input('status'))
                                        selected
                                        @endif
                                >{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="creator" class="form-control">
                            <option></option>
                            @foreach($users as $key => $user)
                                <option value="{{ $user->id }}"
                                        @if ($user->id == Request::input('creator'))
                                        selected
                                        @endif
                                >{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="assignedTo" class="form-control">
                            <option></option>
                            @foreach($users as $key => $user)
                                <option value="{{ $user->id }}"
                                        @if ($user->id == Request::input('assignedTo'))
                                        selected
                                        @endif
                                >{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="tag_id" class="form-control">
                            <option></option>
                            @foreach($tags as $key => $tag)
                                <option value="{{ $tag->id }}"
                                        @if ($tag->id == Request::input('tag_id'))
                                            selected
                                        @endif
                                >{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                            <button type="submit" class="btn btn-primary btn-block">
                                Filter
                            </button>
                    </td>
                </tr>
            </tbody>

        </table>

        </form>
        {{ $tasks->appends($_GET)->links() }}
    </div>
@endsection