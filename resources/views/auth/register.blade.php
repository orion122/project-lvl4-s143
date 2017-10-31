@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-4 my-3 mx-auto">
        <div class="card-block">

            <h2 class="card-title my-3">Register</h2>

                <form class="" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}


                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="my-2">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="my-2">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="my-2">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="my-2">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>


                    <div class="my-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            Register
                        </button>
                    </div>


                </form>
        </div>
    </div>
</div>
@endsection
