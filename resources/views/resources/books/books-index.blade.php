@extends('layouts.default')

@section('title', 'Books')

@section('heading')
    <h1>This is books page</h1>
@endsection

@section('buttons')
    <a class="btn btn-primary" href="{{ route('books.create') }}" role="button"><i class="fa-solid fa-plus"></i> Add New Book</a>
@endsection

@section('content')
    @include('resources.books.books-table', ['books' => $books])
@endsection
