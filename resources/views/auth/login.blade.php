@extends('layouts.master')
@section('content')

<div class="row mt-5 mb-5">
    <div class="col-md-10 offset-md-1">
        <fieldset>

            <legend>Login</legend>
            {!! Form::open(['route' => ['auth.login']]) !!}

            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', '', ['class' => 'form-control']) !!}
                <span class="text-danger">
                  {{ $errors->first('email') }}
                </span>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                <span class="text-danger">
                  {{ $errors->first('password') }}
                </span>
            </div>

            <div class="form-group">
                {!! Form::submit('Login', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
            </div>

            {!! Form::close() !!}
        </fieldset>
    </div>
</div>

@stop
