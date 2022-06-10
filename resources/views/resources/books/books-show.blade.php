<x-layouts.default-layout :title="$book->title" selected="Book" layoutAttributes="id=manage" class="flex-collum">
    <x-slot:links>
        {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"/> --}}
        <link rel="stylesheet" href="{{ asset('css/Booksample.css') }}"/>
    </x-slot>
  
    <x-slot:content>
        <div class="flex-row">
            <div class="leftside-inside"></div>

            <div class="rightside-inside">
                <img class="book-image" src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover">
                <h1 class="booktitle"><b>{{ $book->title }}</b></h1>
                <p class="bookauthor">{{ $book->author }}</p>
                <p class="aboutthebook1">Written in: {{ $book->publication_year }}</p>
                <p class="aboutthebook1">Type: {{ booktypesString($book->booktypes) }}</p>
                <div class="flex-row">
                    <div class="leftside-for-rating">
                        <p class="aboutthebook1">Rating: {{ bookAvgRating($book) }}</p>
                    </div>
                    <div class="rightside-side-for-status">
                        <p class="aboutthebook2">Status: {{ $book->status }}</p>
                    </div>
                </div>
                <p class="overview"><b>Overview</b></p>
                <p class="overviewofoverview">
                    {{ $book->description }}
                </p>
                <div class="this-is-the-class-hold-class-button">
                    <div class="button">
                        <a href="{{ route('users.books.borrows.create', ['book' => $book]) }}">
                            <button class="button-design" {{-- @disabled($book->quantity == 0 && !$book->isUserBorrowing(auth()->user())) --}}>Borrow</button>
                        </a>
                        <a href="{{ route('books.feedbacks.create', ['book' => $book]) }}">
                            <button class="button-design">Feedback</button>
                        </a>
                    </div>
                </div>
                <div class="comment-section">
                    <h1 class="comment-heading">Comment Section:</h1>
                    {{-- Comment here --}}
                    @forelse($book->sortedFeedbacks as $feedback)
                        <div class="flex-collum">
                            <div class="flex-row">
                                <div class="leftside-comment-name">
                                    <p class="comment-person"><b>{{ $feedback->user->fullname }}</b></p>
                                </div>
                                
                                <div class="rightside-comment-date">
                                    <p class="comment-person"><b>Rating: {{ $feedback->rating }}</b></p>
                                    <p class="comment-person"><i>{{ formatDate($feedback->updated_at, 'M j, Y') }}</i></p>
                                </div>
                            </div>
                            <p class="finally-here-is-the-comment">
                                {{ $feedback->comment }}
                            </p>
                        </div>
                        @if($loop->iteration == 10)
                            {{-- <br><a href="{{ route('books.feedbacks.index', ['book' => $book]) }}">More reviews</a><br> --}}
                            @break
                        @endif
                    @empty
                        <div class="flex-collum">
                            <div class="flex-row">
                                <div class="leftside-comment-name">
                                    <p class="comment-person"><b>No comment yet</b></p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="leftside-inside"></div>
        </div>
    </x-slot>
</x-layouts.default-layout>