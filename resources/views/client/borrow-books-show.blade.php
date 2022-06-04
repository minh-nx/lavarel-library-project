@extends('layouts.default')

@section('title', 'Borrow Books')

@section('heading')
    <h1>This is borrow books show page</h1>
@endsection

@section('content')
        <label>User: <b>{{ auth()->user()->fullname }}</b></label>
        <br><br>

        <label>Book: <b>{{ $book->title }}</b></label>
        <br><br>
        
        <label>From: {{ $borrows->borrowed_date }}</label>
        <br><br>

        <label>To: {{ $borrows->due_date }}</label>
        <br><br>

    <form action="{{ route('users.books.borrows.destroy', ['book' => $book]) }}" method="post">
        @csrf
        @method('delete')

        <button>
            <a href="{{ route('users.books.borrows.edit', ['book' => $book]) }}">
                Edit
            </a>
        </button>

        <button type="submit">
            Delete
        </button>
    </form>
    <br>

    <small>This is a temporary button and will be removed when deployed in production environment</small>
    <form action="{{ route('users.books.borrows.return', ['book' => $book]) }}" method="post">
        @csrf
        @method('put')

        <button type="submit">
            Return book
        </button>
    <hr>

    <a href="{{ route('books.show', ['book' => $book]) }}">
        Back
    </a>

    <hr>
    @include('auth.temp.session-message')
@endsection