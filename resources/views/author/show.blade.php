@extends('layouts.master')
@section('content')

<div class="row">
        <div class="col-lg-6 mt-5">
            <fieldset>

                <legend>Author</legend>
                {!! Form::open() !!}

                <div class="form-group">
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name', $author['first_name'], ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name', $author['last_name'], ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('birthday', 'Birthday') !!}
                    {!! Form::date('birthday', \Carbon\Carbon::parse($author['birthday']), ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('biography', 'Biography') !!}
                    {!! Form::textarea('biography', $author['biography'], ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('gender', 'Gender') !!}
                    {!! Form::text('gender', $author['gender'], ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('place_of_birth', 'Place of birth') !!}
                    {!! Form::text('place_of_birth', $author['gender'], ['class' => 'form-control']) !!}
                </div>

                {!! Form::close() !!}

            </fieldset>
        </div>
        <div class="col-lg-6 mt-5">
            <fieldset>
                <legend>Books</legend>
                    <table id="table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>ISBN</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        </thead>
                        <tbody>
                        @foreach ($author['books'] as $book)
                            <tr>
                                <td>{{ $book['title'] }}</td>
                                <td>{{ $book['isbn'] }}</td>
                                <td>
                                    <form action="{{ route('book.delete', ['book' => $book['id']]) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button title="delete" type="submit" class="btn btn-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </fieldset>
        </div>
    </div>

@stop
