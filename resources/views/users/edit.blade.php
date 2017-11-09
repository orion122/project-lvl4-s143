@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-4 my-3 mx-auto">
            <div class="card-block">
                <form class="" method="POST" action="{{ route('users.update', $user->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <h2 class="card-title my-3">Account</h2>

                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label">Name:</label>
                        <div class="col-8">
                            <input class="form-control" name="name" type="text" value="{{ $user->name }}" id="name">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <fieldset disabled>
                        <div class="form-group row">
                            <label for="email" class="col-3 col-form-label">E-mail:</label>
                            <div class="col-8">
                                <input class="form-control" name="email" type="text" value="{{ $user->email }}" id="email">
                            </div>
                        </div>
                    </fieldset>

                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="my-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            Edit account
                        </button>
                    </div>

                </form>

                <form class="" method="POST" action="{{ route('users.destroy', $user) }}"
                      data-confirm="Are you sure you want to delete your account?">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="my-3">
                        <button type="submit" class="btn btn-block btn-sm">
                            Remove account
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
