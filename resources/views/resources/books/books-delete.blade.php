<x-layouts.default-layout title="Confirm Delete" id="bordermother" selected="Admin">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/books-delete.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    </x-slot:links>

    <x-slot:content>
        <div class="background">
            <div id="bordermother">
                <h1><b>Delete Book</b></h1>
                <br>
                <br>
                <br>
                <div class="warning">
                    <b>
                        This action cannot be undone.<br>
                        Are you sure about this?
                    </b>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <form action="{{ route('books.destroy', ['book' => $book]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-link" title="Delete" value="DELETE"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </x-slot:content>
</x-layouts.default-layout>
