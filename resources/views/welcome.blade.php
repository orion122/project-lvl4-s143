@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">SuperTaskman</h1>
            <p class="lead">This is a simple task manager.</p>
            <hr class="my-4">
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="{{ route('tasks.index') }}" role="button">Go to Tasks</a>
            </p>
        </div>
    </div>
@endsection