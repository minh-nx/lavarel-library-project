@extends('layouts.default')

@section('title', 'Borrow Books')

@section('heading')
    <h1>This is borrow books edit page</h1>
@endsection

@section('content')
    <form action="{{ route('books.borrows.update', ['book' => $book]) }}" method="post">
        @csrf
        @method('put')

        <label>User: <b>{{ auth()->user()->fullname }}</b></label>
        <br><br>

        <label>Book: <b>{{ $book->title }}</b></label>
        <br><br>
        
        <label for="borrowed_date">From: </label>
        <input type="date" id="borrowed_date" name="borrowed_date" value="{{ old('borrowed_date', $borrows->borrowed_date) }}" 
                min="{{ $borrows->borrowed_date }}">
        @include('auth.temp.error-message', ['name' => 'borrowed_date'])
        <br><br>

        <label for="term">For: </label>
        <input type="number" id="term" name="term" value="{{ old('term', $term) }}"
                min="1" max="{{ \App\Models\Borrow::BORROW_MAX_DAY }}">
        <label for="term"> day(s)</label>
        @include('auth.temp.error-message', ['name' => 'term'])
        <br><br>

        <button type="button">
            <a href="{{ route('books.borrows.show', ['book' => $book]) }}">
                Back
            </a>
        </button>

        <button type="button">
            <a href="{{ route('books.borrows.edit', ['book' => $book]) }}">
                Reset
            </a>
        </button>

        <button type="submit">
            Submit
        </button>
    </form>

    <hr>
    @include('auth.temp.session-message')
@endsection