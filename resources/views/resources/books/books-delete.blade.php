<x-layouts.default-layout title="Book Delete Confirmation" selected="Admin" layoutAttributes="id=manage">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/books-delete.css') }}" />
{{--        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />--}}
    </x-slot:links>

    <x-slot:content id="bordermother">
        <h1 class="manage-heading">Delete Book</h1>
        <div class="warning">
            <b>
                This action cannot be undone.<br>Are you sure about this action?
            </b>
        </div>
        <form action="{{ route('test.books.destroy', ['book' => $book]) }}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" value="Delete Book" onclick="alert('The book has been deleted!\nReturning to the bookshelf...')">
        </form>
    </x-slot:content>
</x-layouts.default-layout>
