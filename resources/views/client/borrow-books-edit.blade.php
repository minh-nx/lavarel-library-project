<x-layouts.default-layout title="Borrow book" selected="Book" layoutAttributes="id=manage">
    <x-slot:links>
        {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"/> --}}
        <link rel="stylesheet" href="{{ asset('css/Borrowbook.css') }}"/>
    </x-slot>
  
    <x-slot:content class="flex-column">
        <div class="leftside">
            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" class="book-image">
        </div>
        <div class="rightside">
            <form action="{{ route('users.books.borrows.update', ['book' => $book]) }}" method="post">
                @csrf
                @method('put')

                <h1 class="heading">Borrow</h1>
                <h2 class="book-title">{{ $book->title }}</h2>
                <h3 class="author">{{ $book->author }}</h3>
                <div class="setting-flex-in-form">
                    <div class="flex-column">
                        <div class="leftside">
                            <label for="borrowed_date" class="lable-form">From:</label><br>
                            <input type="date" id="borrowed_date" name="borrowed_date" value="{{ old('borrowed_date', $borrows->borrowed_date) }}" 
                                    min="{{ $borrows->borrowed_date }}" required><br>
                        </div>

                        <div class="rightside">
                            <label for="term" class="lable-form">For:</label><br>
                            <input type="number" id="term" name="term" value="{{ old('term', $term) }}" min="1" 
                                    max="{{ \App\Models\Borrow::BORROW_MAX_DAY }}" placeholder="1-{{ \App\Models\Borrow::BORROW_MAX_DAY }}" 
                                    required autocomplete="off">
                            <label class="lable-form">day(s)</label>
                        </div>
                    </div>
                </div>
                <div class="this-class-hold-borrow-button">
                    <input type="submit" value="Edit">
                </div>
            </form>
        </div>
    </x-slot>
  </x-layouts.default-layout>