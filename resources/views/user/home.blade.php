<x-layouts.default-layout title="Home" id="home" selected="Home">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
        
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
        <div class="intro">
            <div class="intro__image">
                <img
                    src="{{ asset('img/library1.jpg') }}"
                    alt="library image"
                    class="image"
                />
            </div>
            <div class="intro__content">
                <div class="intro__title">
                    <h4 class="intro__text">Welcome to TinyProject Public Library</h4>
                </div>
              <div class="intro__desc">
                <span class="intro__text--small"
                  >Grab-and-go book checkout services now available</span
                >
              </div>
              <div class="button__area">
                <div class="button">
                    <a class="button__left" href="{{ route('register') }}">Sign up</a>
                </div>
                <div class="button"><span class="button__mid">Or</span></div>
                <div class="button">
                    <a class="button__right" href="{{ route('login') }}">Sign in</a>
                </div>
              </div>
            </div>
            <div class="arrow">
                <i class="fa fa-arrow-down"></i>
            </div>
          </div>
          <div class="book">
            <div class="book__header">
                <div class="book__title">
                    <h3>Books</h3>
                </div>
                <div class="book__desc">
                    <span>We have a variety and all kinds of books.</span>
                </div>
            </div>
            <div class="book__catalog">
                <ul class="book__list">
                    @foreach($books as $book)
                        <li class="book__item">
                            <img
                                src="{{ $book->cover_image }}"
                                alt="{{ $book->title }}'s cover"
                                class="book__image"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="book__more">
                <span class="book__more-text">
                    <a href="{{ route('books.search-page') }}">Our Books</a>
                </span>
            </div>
          </div>
          <div class="about">
            <div class="about__screen">
                <img src="{{ asset('img/lib.png') }}" alt="image" class="about__image" />
                <div class="about__box">
                    <div class="about__text">
                        <h2 class="about__title">About Our Library</h2>
                        <p class="about__desc">
                            Feel boring in life and want to find a place to enjoy your book.
                            Come with us we have a peaceful environment that will recharge
                            your energy after the stressful week.
                        </p>
                        <div class="about__button">
                            <span class="about__button--text">
                                <a href="{{ route('about-us') }}">Learn More</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layouts.default-layout>
