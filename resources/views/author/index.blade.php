@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <table id="table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Summary</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        </thead>
                        <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->summary }}</td>
                                <td>{{ $author->status }}</td>
                                <td>{{ $author->due_date }}</td>
                                <td>
                                    <form action="{{ route('author.delete', ['id' => $author->id]) }}" method="post" style="display: inline-block">
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
                </div>
            </div>
        </div>
    </div>

@stop