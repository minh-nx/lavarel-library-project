<x-layouts.default-layout title="Create feedback" selected="Book" layoutAttributes="id=manage">
    <x-slot:links>
        {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"/> --}}
        <link rel="stylesheet" href="{{ asset('css/Feedback-new.css') }}">
    </x-slot>
  
    <x-slot:content class="bordermother">
        <div class="flex-column">
            <div class="leftside">
                <img class="image-cover" src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover">
            </div>

            <div class="rightside">
                <h1 class="book-title">{{ $book->title }}</h1>
                <h2 class="author">{{ $book->author }}</h2>
                <h3 class="normalthing">Written in: {{ $book->publication_year }}</h3>
                <h3 class="normalthing">Rating: {{ bookAvgRating($book) }}</h3>
            </div>
        </div>

        <form class="comment-form" action="{{ route('books.feedbacks.store', ['book' => $book]) }}" method="post">
            @csrf

            <label for="rating">Your Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="10" value="{{ old('rating') }}" placeholder="1-10" 
                    required autocomplete="off" autofocus><br>
                    
            <label for="comment">Your Comment:</label><br>
            <textarea id="comment" name="comment" placeholder="Write your comment here...">{{ old('comment') }}</textarea>
            <div class="this-is-the-class-hold-class-button">
                <div class="flex-column">
                    <div class="leftside-button">
                        <a href="{{ route('books.show', ['book' => $book]) }}">
                            <button type="button" class="back-button">Back</button>
                        </a>
                    </div>
                    <div class="rightside-button">
                        <input type="submit" class="submit-button">
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
</x-layouts.default-layout>