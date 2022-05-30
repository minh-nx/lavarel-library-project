@extends('layouts.default')

@section('title', 'Borrow Books')

@section('heading')
    <h1>This is borrow books index page</h1>
@endsection

@section('content')
    @if($records->isEmpty())
        <p>No borrow records found</p>
    @else
        <table style="width:100%">
            <thead style="text-align: center;">
                <th>Cover Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Borrowed Date</th>
                <th>Due Date</th>
                <th>Returned Date</th>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td style="text-align: center;"> 
                            <a href="{{ route('books.show', ['book' => $record->book]) }}" title="Click to view '{{ $record->book->title }}'"> 
                                <img src="{{ $record->book->cover_image }}" alt="{{ $record->book->title }}'s cover" style="max-width:200px; max-height:200px"> 
                            </a> 
                        </td>
                        <td> {{ $record->book->title }} </td>
                        <td> {{ $record->book->author }} </td>
                        <td style="text-align: center;"> {{ formatDate($record->borrowed_date) }} </td>
                        <td style="text-align: center;"> {{ formatDate($record->due_date) }} </td>
                        <td style="text-align: center;"> {{ isset($record->returned_date) ? formatDate($record->returned_date) : '-' }} </td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        {{ $records->links() }}
    @endif
@endsection