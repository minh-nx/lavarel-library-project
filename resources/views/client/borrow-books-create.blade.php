@extends('layouts.default')

@section('title', 'Borrow Books')

@section('heading')
    <h1>This is borrow book create page</h1>
@endsection

@section('content')
    <form action="{{ route('users.books.borrows.store', ['book' => $book]) }}" method="POST">
        @csrf

        <label>User: <b>{{ auth()->user()->fullname }}</b></label>
        <br><br>

        <label>Book: <b>{{ $book->title }}</b></label>
        <br><br>
        
        <label for="borrowed_date">From: </label>
        <input type="date" id="borrowed_date" name="borrowed_date" value="{{ old('borrowed_date', now()->format('Y-m-d')) }}" 
                min="{{ now()->format('Y-m-d') }}">
        @include('auth.temp.error-message', ['name' => 'borrowed_date'])
        <br><br>

        <label for="term">For: </label>
        <input type="number" id="term" name="term" value="{{ old('term', 1) }}"
                min="1" max="{{ \App\Models\Borrow::BORROW_MAX_DAY }}">
        <label for="term"> day(s)</label>
        @include('auth.temp.error-message', ['name' => 'term'])
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