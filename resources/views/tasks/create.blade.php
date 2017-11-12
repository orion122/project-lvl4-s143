@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-6 my-3 mx-auto">
            <div class="card-block">

                <form class="" method="POST" action="{{ route('tasks.store', Auth::user()) }}">
                    {{ csrf_field() }}

                    <h2 class="card-title my-3">New Task</h2>

                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label">Name:</label>
                            <input class="form-control col-8" name="name" type="text" id="name" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>


                    <div class="form-group row">
                        <label for="description" class="col-3 col-form-label">Description:</label>
                            <textarea class="form-control col-8" name="description" id="description" cols="" rows=""></textarea>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>


                    <div class="form-group row">
                        <label for="assignedTo" class="col-3 col-form-label">Assigned To:</label>

                            <select class="form-control col-8" name="assignedTo" id="assignedTo">
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }} ({{ Auth::user()->email }})</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>

                            @if ($errors->has('assignedTo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('assignedTo') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group row">
                        <label for="tags" class="col-3 col-form-label">Tags:</label>
                            <input class="form-control col-8" name="tags" type="text" id="tags" required>

                            @if ($errors->has('tags'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tags') }}</strong>
                                </span>
                            @endif
                        </div>

                    <input type="hidden" name="creator" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="status" value="1">

                    <div class="my-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            Create Task
                        </button>
                    </div>

                </form>



                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
