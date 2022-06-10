<x-layouts.default-layout title="Book" selected="Book" class="book">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/book_shelf.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Raleway&display=swap"
          rel="stylesheet"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway&display=swap"
          rel="stylesheet"
        />
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"
        />
    </x-slot>
  
    <x-slot:content>
        <div class="container">
            <div class="container__title"><h2>Book shelf</h2></div>
            <div class="container__desc"><span>Explore our collection</span></div>
            <div class="container__search">
                <form action="{{ route('books.search') }}" method="get">
                    <div>
                        <input placeholder="Search" class="container__input" name="title"/>
                    </div>
                </form>
            </div>
            <div class="container__book">
                <div class="book__container">
                    @foreach ($books as $book)
                        <div class="book__slot">
                            <div class="book__img">
                                <a href="{{ route('books.show', ['book' => $book]) }}">
                                    <img class="img__book" src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" />
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('users.books.borrows.create', ['book' => $book]) }}">
                                    <button class="book__button">Borrow</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-slot>
  </x-layouts.default-layout>