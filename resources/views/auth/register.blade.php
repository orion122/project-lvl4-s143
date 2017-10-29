@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-4 my-3 mx-auto">
        <div class="card-block">

            <h2 class="card-title my-3">Register</h2>

                <form class="" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="my-2">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                    </div>

                    <div class="my-2">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                    </div>

                    <div class="my-2">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <div class="my-2">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>

                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>

                </form>
        </div>
    </div>
</div>
@endsection
