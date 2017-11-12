@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-6 my-3 mx-auto">
            <div class="card-block">


                {{ Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'patch']) }}
                <h2 class="card-title my-3">Edit Task</h2>
                {{ Form::bsText('name', $task->name) }}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif


                <div class="form-group row">
                    <label for="description" class="col-3 col-form-label">Description:</label>
                    {{ Form::textarea('description', $task->description, ['class' => 'form-control col-8', 'rows' => 2]) }}
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                </div>


                <div class="form-group row">
                    <label for="assignedTo" class="col-3 col-form-label">Assigned To:</label>
                    {{ Form::select('assignedTo', $namesAndEmails, $task->assigned->id, ['class' => 'form-control col-8']) }}
                </div>


                {{ Form::bsText('tags', implode(',', $task->tags->pluck('name')->toArray())) }}
                    @if ($errors->has('tags'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tags') }}</strong>
                        </span>
                    @endif


                <div class="form-group row">
                    <label for="status" class="col-3 col-form-label">Status:</label>
                    {{ Form::select('status', $statuses, $task->taskStatus->id, ['class' => 'form-control col-8']) }}
                </div>


                <input type="hidden" name="creator" value="{{ $task->owner->id }}">


                {{ Form::bsSubmit('Edit Task', ['class' => 'btn btn-primary btn-block']) }}
                {{ Form::close() }}

                {{ Form::open(['route' => ['tasks.destroy', $task], 'method' => 'DELETE', 'data-confirm' => 'Are you sure you want to delete your task?']) }}
                {{ Form::bsSubmit('Remove Task', ['class' => 'btn btn-block btn-sm']) }}
                {{ Form::close() }}

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
