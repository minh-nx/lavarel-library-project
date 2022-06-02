@extends('layouts.default')

@section('title', 'Edit feedback')

@section('heading')
    <h1>This is feedback edit page</h1>
@endsection

@section('content')
    <form action="{{ route('books.feedbacks.update', ['book' => $book, 'feedback' => $feedback]) }}" method="post">
        @csrf
        @method('put')

        <label for="rating">Rating: </label>
        <input type="number" id="rating" name="rating" value="{{ old('rating', $feedback->rating) }}" min="1" max="10" rows="3" autofocus>
        @include('auth.temp.error-message', ['name' => 'rating'])
        <br>

        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="6" cols="60">{{ old('comment', $feedback->comment) }}</textarea>
        @include('auth.temp.error-message', ['name' => 'comment'])
        <br>
    
        <button type="button">
            <a href="{{ route('books.show', ['book' => $book]) }}">
                Back
            </a>
        </button>

        <button type="button">
            <a href="{{ route('books.feedbacks.edit', ['book' => $book, 'feedback' => $feedback]) }}">
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