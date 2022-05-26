@extends('layouts.default')

@section('title', 'Borrow Book')

@section('heading')
    <h1>This is borrow book show page</h1>
@endsection

@section('content')
        <label>User: <b>{{ auth()->user()->fullname }}</b></label>
        <br><br>

        <label>Book: <b>{{ $book->title }}</b></label>
        <br><br>
        
        <label>From: {{ $from->format('Y-m-d') }}</label>
        <br><br>

        <label>To: {{ $to->format('Y-m-d') }}</label>
        <br><br>

    <form action="{{ route('books.borrows.destroy', ['book' => $book]) }}" method="post">
        @csrf
        @method('delete')

        <button type="submit">
            Delete
        </button>
    </form>

    <hr>
    <a href="{{ route('books.show', ['book' => $book]) }}">
        Back
    </a>

    <hr>
    @include('auth.temp.session-message')
@endsection