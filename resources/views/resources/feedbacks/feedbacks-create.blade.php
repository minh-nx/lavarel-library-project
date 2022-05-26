@extends('layouts.default')

@section('title', 'Create feedback')

@section('heading')
    <h1>This is feedback create page</h1>
@endsection

@section('content')
    <form action="{{ route('books.feedbacks.store', ['book' => $book]) }}" method="post">
        @csrf

        <label for="rating">Rating: </label>
        <input type="number" id="rating" name="rating" value="{{ old('rating', 5) }}" min="1" max="10" step="1" rows="3">
        @include('auth.temp.error-message', ['name' => 'rating'])
        <br>

        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="6" cols="60">{{ old('comment') }}</textarea>
        @include('auth.temp.error-message', ['name' => 'comment'])
        <br>
    
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