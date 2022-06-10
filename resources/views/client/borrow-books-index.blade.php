<x-layouts.default-layout title="Borrow History" selected="User">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/history.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Raleway"
        />
    </x-slot>
  
    <x-slot:content id="borrow">
        <div class="borrowing">
            <div class="borrowing__title">
                <h1>Borrowing</h1>
            </div>
            @if($records->isEmpty())
                <p>No borrow records found</p>
            @else
                <div class="borrowing__table">
                    <table class="borrow__table">
                        <tr class="borrowing__table--title">
                            <th>Cover Image</th>
                            <th>Titles</th>
                            <th>Author</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Return Date</th>
                        </tr>
                        @foreach($records as $record)
                            <tr>
                                <td style="text-align: center;"> 
                                    <a href="{{ route('books.show', ['book' => $record->book]) }}" title="Click to view '{{ $record->book->title }}'"> 
                                        <img src="{{ $record->book->cover_image }}" alt="{{ $record->book->title }}'s cover" style="max-width:200px; max-height:200px"> 
                                    </a> 
                                </td>
                                <td> {{ $record->book->title }} </td>
                                <td> {{ $record->book->author }} </td>
                                <td> {{ formatDate($record->borrowed_date) }} </td>
                                <td> {{ formatDate($record->due_date) }} </td>
                                <td> {{ formatDate($record->returned_date) }} </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $records->links() }}
                </div>
            @endif
        </div>
    </x-slot>
  </x-layouts.default-layout>