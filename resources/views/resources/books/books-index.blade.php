@extends('layouts.default')

@section('title', 'Books')

@section('heading')
    <h1>This is books page</h1>
@endsection

@section('content')
    @include('resources.books.books-table', ['books' => $books])
@endsection