@extends('layouts.default')

@section('title', 'Create Book')

@section('heading')
    <h1>This is book create page</h1>
@endsection

@section('content')
    <div class="col">
        <form action="{{ route('books.update', ['book' => $book]) }}" method="POST">
            @method('PUT')
            @include('resources.books.books-fields')

            <div class="form-group row">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <div class="col-sm-9">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
