@extends('layouts.default')

@section('title', 'Book feedback')

@section('heading')
    <h1>This is feedback index page</h1>
@endsection

@section('content')
    <a href="{{ route('books.show', ['book' => $book]) }}"><h2> {{ $book->title }} </h2></a>
    <br><br>

    @forelse($feedbacks as $feedback)
        <p><b>{{ $feedback->user->fullname }}</b> ({{ formatDate($feedback->updated_at, 'M j, Y') }})</p>
        <p><b>Rating: </b> {{ $feedback->rating }} </p>
        <p>{{ $feedback->comment }}</p>
        <br>
    @empty
        <p>No comment yet</p>
    @endforelse

    {{ $feedbacks->links() }}

@endsection