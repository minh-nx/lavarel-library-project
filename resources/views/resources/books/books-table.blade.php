@if($books->isEmpty())
    <p>Sorry, no result found T.T</p>
@else
    @php
        $books->loadAvg('feedbacks as average_rating', 'rating');
    @endphp

    <table style="width:100%">
        <thead style="text-align: center;">
            <th>Cover Image</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publication Year</th>
            <th>Type</th>
            <th>Rating</th>
            <th>Status</th>
            @can('books.update')
                <th>Action</th>
            @endcan
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td style="text-align: center;">
                        <a href="{{ route('test.books.show', ['book' => $book]) }}">
                            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover" style="max-width:200px; max-height:200px;">
                        </a>
                    </td>
                    <td> {{ $book->title }} </td>
                    <td> {{ $book->author }} </td>
                    <td style="text-align: center;"> {{ $book->publication_year }} </td>
                    <td> {{ booktypesString($book->booktypes) }} </td>
                    <td style="text-align: center;"> {{ bookAvgRating($book) ?? '--' }} </td>
                    <td style="text-align: center;"> {{ $book->status }} </td>
                    @can('books.update')
                        <td style="text-align: right;"><a href="{{ route('test.books.edit', ['book' => $book]) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a></td>
                    @endcan
                    @can('books.delete')
                    <td style="text-align: left;"><a href="{{ route('test.books.confirm', ['book' => $book]) }}"><i class="fa fa-trash"></i> Delete</a></td>
                    @endcan
                </tr>
            </tbody>
        @endforeach
    </table>
    <br>
    {{ $books->links() }}
@endif
