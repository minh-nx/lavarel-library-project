@if($books->isEmpty())
    <p>Sorry, no result found T.T</p>
@else
    @php
        $books->loadAvg('feedbacks as average_rating', 'rating');
    @endphp
    
    <table>
        <thead>
            <th>Cover image</th>
            <th>Title</th>
            <th>Rating</th>
            <th>Author</th>
            <th>Publication year</th>
            <th>Description</th>
            <th>Quantity</th>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td> 
                        <a href="{{ route('books.show', ['book' => $book]) }}" title="Click to view '{{ $book->title }}'"> 
                            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" style="max-width:200px; max-height:200px"> 
                        </a> 
                    </td>
                    <td> {{ $book->title }} </td>
                    <td> {{ isset($book->average_rating) ? round($book->average_rating, 2) : '-' }} </td>
                    <td> {{ $book->author }} </td>
                    <td> {{ $book->publication_year }} </td>
                    <td> {{ $book->description }} </td>
                    <td> {{ $book->quantity }} </td>
                    @can('books.update')
                        <td><a href="{{ route('books.edit', ['book' => $book]) }}">Edit</a></td>
                    @endcan
                </tr>
            </tbody>
        @endforeach
    </table>

    {{ $books->links() }}
@endif