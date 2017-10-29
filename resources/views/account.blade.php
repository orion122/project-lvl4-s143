@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-4 my-3 mx-auto">
            <div class="card-block">

                <h2 class="card-title my-3">Account</h2>

                <div class="form-group row">
                    <label for="example-text-input" class="col-3 col-form-label">Name:</label>
                    <div class="col-8">
                        <input class="form-control" type="text" value="{{ Auth::user()->name }}" id="example-text-input">
                    </div>
                </div>


                <fieldset disabled>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-3 col-form-label">E-mail:</label>
                        <div class="col-8">
                            <input class="form-control" type="text" value="{{ Auth::user()->email }}" id="example-text-input">
                        </div>
                    </div>
                </fieldset>

                <div class="my-3">
                    <button type="submit" class="btn btn-primary">
                        Change
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
