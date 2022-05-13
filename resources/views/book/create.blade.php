@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-10  offset-md-1 mt-5">
            <a class="btn btn-danger float-right" href="{{ route('book.index') }}" role="button">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-md-1 mt-5">
            <fieldset>

                <legend>Create New Book</legend>
                {!! Form::open(['route' => ['book.store']]) !!}

                <div class="form-group">
                    {!! Form::label('author', 'Author') !!}
                    {!! Form::select('author', $authors, old('author'), ['class' => 'form-control', 'placeholder' => 'Pick an author...']) !!}
                    <span class="text-danger">
                        {{ $errors->first('author') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                    <span class="text-danger">
                        {{ $errors->first('title') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::label('release_date', 'Release date') !!}
                    {!! Form::date('release_date', old('release_date'), ['class' => 'form-control']) !!}
                    <span class="text-danger">
                        {{ $errors->first('release_date') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                    <span class="text-danger">
                        {{ $errors->first('description') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::label('isbn', 'ISBN') !!}
                    {!! Form::text('isbn', old('isbn'), ['class' => 'form-control']) !!}
                    <span class="text-danger">
                        {{ $errors->first('isbn') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::label('format', 'Format') !!}
                    {!! Form::text('format', old('format'), ['class' => 'form-control']) !!}
                    <span class="text-danger">
                        {{ $errors->first('format') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::label('number_of_pages', 'Number of pages') !!}
                    {!! Form::number('number_of_pages', old('number_of_pages'), ['class' => 'form-control']) !!}
                    <span class="text-danger">
                        {{ $errors->first('number_of_pages') }}
                    </span>
                </div>

                <div class="form-group">
                    {!! Form::submit('Create', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
                </div>

                {!! Form::close() !!}

            </fieldset>
        </div>
    </div>

@stop
