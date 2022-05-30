@extends('layouts.default')

@section('title', 'Books')

@section('heading')
    <h1>This is search books page</h1>
@endsection

@section('content')
    <form action="{{ route('books.search') }}" action="get">
        <label for="title">By Title: </label>
        <input type="text" id="title" name="title">
        <br><br>

        <label for="author">By Author: </label>
        <input type="text" id="author" name="author">
        <br><br>

        <label for="publication_year">By Publication Year: </label>
        <input type="text" id="publication_year" name="publication_year">
        <br><br>

        <label>Types: </label>
        @foreach($booktypes as $booktype)
            <input type="checkbox" id="{{ $booktype->id }}" name="booktypes[]" value="{{ $booktype->id }}">
            <label for="{{ $booktype->id }}" title="{{ $booktype->description }}"> {{ $booktype->name }} </label>
        @endforeach
        <br><br>

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