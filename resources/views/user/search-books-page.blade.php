@extends('layouts.default')

@section('title', 'Books')

@section('heading')
    <h1>This is search books page</h1>
@endsection

@section('content')
    <form action="{{ route('books.search') }}" action="get">
        <input type="text" id="search" name="title" placeholder="Search books"> 
        <button type="submit">
            Search
        </button> 
    </form>

    <h3>Search result:</h3>
    <br><br>

    @isset($books)
        @include('resources.books.books-table', ['books' => $books])
    @endisset
@endsection