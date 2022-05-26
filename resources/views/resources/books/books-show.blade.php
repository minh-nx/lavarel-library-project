@extends('layouts.default')

@section('title', $book->slug)

@section('heading')
    <h1>This is detail book page</h1>
@endsection

@section('content')
    <h2> {{ $book->title }} </h2>
    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" style="max-width:400px; max-height:600px">
    <p> <b>Rating:</b> {{ isset($book->average_rating) ? round($book->average_rating, 2) : '-' }}/10 </p>
    <p> <b>Author:</b> {{ $book->author }} </p>
    <p> <b>Publication year:</b> {{ $book->publication_year }} </p>
    <p> <h4>Description:</h4>
        {{ $book->description }}
    </p>
    <p> <b>Quantity:</b> {{ $book->quantity }} </p>
    <p> <b>Status:</b> 
        @if($book->quantity > 0)
            Available
        @else
            Out of stock
        @endif
    </p>

    <br>

    <h4>Comments:</h4>
    @forelse($book->sortedFeedbacks as $feedback)
        <p><b>{{ $feedback->user->fullname }}</b> ({{ $feedback->updated_at->format('M j, Y') }})</p>
        <p><b>Rating: </b> {{ $feedback->rating }} </p>
        <p>{{ $feedback->comment }}</p>

        @break($loop->iteration== 10)
        <br>
    @empty
        <p>No comment yet</p>
    @endforelse


    <br>
    <a href="{{ route('books.borrows.create', ['book' => $book]) }}">Borrow</a>
    <br>

    <a href="{{ route('books.feedbacks.create', ['book' => $book]) }}">Feedback</a>
    <br>
@endsection