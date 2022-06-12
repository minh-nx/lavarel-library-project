<x-layouts.default-layout title="Book List" selected="Admin">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/books-list.css') }}"/>
    </x-slot:links>

    <script src="https://kit.fontawesome.com/884056f55a.js" crossorigin="anonymous"></script>

    <x-slot:content>
        @if($books->isEmpty())
            <p>Sorry, no result found T.T</p>
        @else
            @php
                $books->loadAvg('feedbacks as average_rating', 'rating');
            @endphp

            <div>
                <h1 class="booklist">Book List</h1>
                <table>
                    <tr>
                        <th style="size:20%">Cover Image</th>
                        <th style="size:15%">Title</th>
                        <th style="size:15%">Author</th>
                        <th style="size:10%">Publication Year</th>
                        <th style="size:10%">Type</th>
                        <th style="size:10%">Rating</th>
                        <th style="size:10%">Status</th>
    {{--                        @can('books.update')--}}
                        <th style="size:10%; text-align: center">Action</th>
    {{--                        @endcan--}}
                    </tr>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>
                                    <a href="{{ route('test.books.show', ['book' => $book]) }}">
                                        <img class="book-image" src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" style="max-width:200px; max-height:200px;">
                                    </a>
                                </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publication_year }}</td>
                                <td>{{ booktypesString($book->booktypes) }}</td>
                                <td>{{ bookAvgRating($book) ?? '--' }}</td>
                                <td>{{ $book->status }}</td>
{{--                                @can('books.update')--}}
                                    <td><a href="{{ route('test.books.edit', ['book' => $book]) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a></td>
{{--                                @endcan--}}
{{--                                @can('books.delete')--}}
                                    <td><a href="{{ route('test.books.confirm', ['book' => $book]) }}"><i class="fa fa-trash"></i> Delete</a></td>
{{--                                @endcan--}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            {{ $books->links() }}
        @endif
    </x-slot:content>
</x-layouts.default-layout>
