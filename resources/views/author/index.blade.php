@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-lg-6 mt-5">
            <h5>Authors</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <table id="table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        </thead>
                        <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author['first_name'] }}</td>
                                <td>{{ $author['last_name'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($author['birthday'])->format('d F Y') }}</td>
                                <td>
                                    <a title="show" class="btn btn-info" href="{{ route('author.show', ['author' => $author['id']]) }}" role="button">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    @if(!isset($author['books']))
                                    <form action="{{ route('author.delete', ['author' => $author['id']]) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button title="delete" type="submit" class="btn btn-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop