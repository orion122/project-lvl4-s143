@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-6 my-3 mx-auto">
            <div class="card-block">

                {{ Form::open(['route' => ['tasks.store', Auth::user()]]) }}
                <h2 class="card-title my-3">New Task</h2>

                {{ Form::bsText('name') }}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif


                <div class="form-group row">
                    <label for="description" class="col-3 col-form-label">Description:</label>
                    {{ Form::textarea('description', '', ['class' => 'form-control col-8', 'rows' => 2]) }}
                    @if ($errors->has('description'))
                        <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                    @endif
                </div>


                <div class="form-group row">
                    <label for="assignedTo" class="col-3 col-form-label">Assigned To:</label>
                    {{ Form::select('assignedTo', $namesAndEmails, '', ['class' => 'form-control col-8']) }}
                </div>

                {{ Form::bsText('tags') }}
                @if ($errors->has('tags'))
                    <span class="help-block">
                            <strong>{{ $errors->first('tags') }}</strong>
                        </span>
                @endif


                <input type="hidden" name="creator" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status" value="1">


                {{ Form::bsSubmit('Create Task', ['class' => 'btn btn-primary btn-block']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
