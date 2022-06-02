@extends('layouts.default')

@section('title', 'Show feedback')

@section('heading')
    <h1>This is feedback show page</h1>
@endsection

@section('content')

    <label for="rating">Rating: </label>
    <input type="number" id="rating" name="rating" value="{{ $feedback->rating }}" min="1" max="10" rows="3" readonly>
    <br>

    <label for="comment">Comment:</label><br>
    <textarea id="comment" name="comment" rows="6" cols="60" readonly>{{ $feedback->comment }}</textarea>
    <br>

    <form action="{{ route('books.feedbacks.destroy', ['book' => $book, 'feedback' => $feedback]) }}" method="post">
        @csrf
        @method('delete')

        <button type="button">
            <a href="{{ route('books.show', ['book' => $book]) }}">
                Back
            </a>
        </button>

        <button type="button">
            <a href="{{ route('books.feedbacks.edit', ['book' => $book, 'feedback' => $feedback]) }}">
                Edit
            </a>
        </button>

        <button type="submit">
            Delete
        </button>
    </form>

    <hr>
    @include('auth.temp.session-message')
@endsection