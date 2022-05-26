@extends('layouts.default')

@section('title', 'Borrow Book')

@section('heading')
    <h1>This is borrow book create page</h1>
@endsection

@section('content')
    <form action="{{ route('books.borrows.store', ['book' => $book]) }}" method="POST">
        @csrf

        <label>User: <b>{{ auth()->user()->fullname }}</b></label>
        <br><br>

        <label>Book: <b>{{ $book->title }}</b></label>
        <br><br>
        
        <label for="borrowed_date">From: </label>
        <input type="date" id="borrowed_date" name="borrowed_date" value="{{ now()->format('Y-m-d') }}" 
                min="{{ now()->format('Y-m-d') }}">
        @include('auth.temp.error-message', ['name' => 'borrowed_date'])
        <br><br>

        <label for="due_date">To: </label>
        <input type="date" id="due_date" name="due_date" value="{{ now()->addDay()->format('Y-m-d') }}"
                min="{{ now()->format('Y-m-d') }}">
        @include('auth.temp.error-message', ['name' => 'due_date'])
        <br><br>

        <button type="submit">
            Submit
        </button>
    </form>
    <hr>

    <a href="{{ route('books.show', ['book' => $book]) }}">
        Back
    </a>

    <hr>
    @include('auth.temp.session-message')
@endsection