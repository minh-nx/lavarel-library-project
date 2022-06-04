@extends('layouts.default')

@section('title', 'Books')

@section('heading')
    <h1>This is books page</h1>
@endsection

@section('buttons')
    <div>
        <div style="float:left;">
            <a class="btn btn-primary" href="{{ route('books.create') }}" role="button" style="display: inline-block"><i class="fa-solid fa-plus"></i> Add New Book</a>
        </div>
        <div style="float:right">
            {{ $books->links() }}
        </div>
        <div style="clear:both"></div>
    </div>
@endsection

@section('content')
    @include('resources.books.books-table', ['books' => $books])
@endsection
