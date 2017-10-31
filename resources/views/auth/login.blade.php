@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-4 my-3 mx-auto">
        <div class="card-block">

            <h2 class="card-title my-3">Login</h2>

            <form class="" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="my-2">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                </div>

                <div class="">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <div class="my-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <div class="my-3">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                    {{--<a class="btn" href="{{ route('password.request') }}">--}}
                        {{--Forgot Your Password?--}}
                    {{--</a>--}}
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
