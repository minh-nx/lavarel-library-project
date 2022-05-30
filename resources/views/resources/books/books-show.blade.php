@extends('layouts.default')

@section('title', $book->slug)

@section('heading')
    <h1>This is detail book page</h1>
@endsection

@section('content')
    <a href="{{ route('books.search-page') }}">Back</a>
    <br><br>

    <h2> {{ $book->title }} </h2>
    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" style="max-width:400px; max-height:600px">
    <p> <b>Author:</b> {{ $book->author }} </p>
    <p> <b>Publication year:</b> {{ $book->publication_year }} </p>
    <p> <b>Types: </b> {{ booktypesString($book->booktypes) }} </p>
    <p> <b>Rating:</b> {{ bookAvgRating($book) }}/10 </p>
    <p> <h4>Description:</h4>
        {{ $book->description }}
    </p>
    <p> <b>Quantity:</b> {{ $book->quantity }} </p>
    <p> <b>Status:</b> {{ ($book->quantity > 0) ? 'Available' : 'Unavailable' }} </p>

    <br>

    <h4>Comments:</h4>
    @forelse($book->sortedFeedbacks as $feedback)
        <p><b>{{ $feedback->user->fullname }}</b> ({{ formatDate($feedback->updated_at, 'M j, Y') }})</p>
        <p><b>Rating: </b> {{ $feedback->rating }} </p>
        <p>{{ $feedback->comment }}</p>

        @if($loop->iteration == 1)
            <br><a href="{{ route('books.feedbacks.index', ['book' => $book]) }}">More reviews</a><br>
            @break
        @endif
    @empty
        <p>No comment yet</p>
    @endforelse


    <br>
    <a href="{{ route('books.borrows.create', ['book' => $book]) }}">Borrow</a>
    <br>

    <a href="{{ route('books.feedbacks.create', ['book' => $book]) }}">Feedback</a>
    <br>

    <hr>
    @include('auth.temp.session-message')
@endsection