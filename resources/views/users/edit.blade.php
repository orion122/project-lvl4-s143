@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-4 my-3 mx-auto">
            <div class="card-block">

                {{ Form::model($user, ['route' => ['users.update', $user], 'method' => 'patch']) }}
                <h2 class="card-title my-3">Account</h2>
                {{ Form::bsText('name', $user->name) }}

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <fieldset disabled>
                    {{ Form::bsText('email', $user->email) }}
                </fieldset>

                {{ Form::bsSubmit('Edit Account', ['class' => 'btn btn-block btn-primary']) }}
                {{ Form::close() }}


                {{ Form::open(['route' => ['users.destroy', $user], 'method' => 'DELETE', 'data-confirm' => 'Are you sure you want to delete your account?']) }}
                {{ Form::bsSubmit('Remove Account', ['class' => 'btn btn-block btn-sm']) }}
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
