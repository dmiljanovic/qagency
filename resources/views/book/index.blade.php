@extends('layouts.master')
@section('content')


    <div class="row">
        <div class="col-lg-6 mt-5">
            <h5>Books</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-5">
            <a class="btn btn-success" href="{{ route('book.create') }}" role="button">New Book</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="row">
                <div class="col-lg-12 mt-5">
                <table id="table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>ISBN</th>
                        </tr>
                        </thead>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book['title'] }}</td>
                                <td>{{ $book['isbn'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop