<x-layouts.default-layout title="Add Book" selected="Admin" layoutAttributes="id=manage">
    <x-slot:links>
        <link rel="stylesheet" href="{{ asset('css/books-add.css') }}"/>
    </x-slot:links>

    <script language="JavaScript">
        function toggleSelect(target) {
            checkboxes = document.getElementsByName('booktype_ids[]');
            for(var i=0, n=checkboxes.length; i<n; i++) {
                checkboxes[i].checked = target.checked;
            }
        }
    </script>

    <x-slot:content id="bordermother">
        <h1 class="manage-heading">Add Book</h1>
        <form action="{{ route('test.books.store') }}" method="POST" enctype="multipart/form-data">
            <div class="flex-row">
                <div class="leftside">
                    <label for="name">Title</label><br>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $book->title ?? '' }}" required><br>
                    <span><small></small></span>
                    <br>
                    <label for="pub">Publication Year</label><br>
                    <input type="number" min="1" max="2022" step="1" name="publication_year" class="form-control" id="publication_year" value="{{ $book->publication_year ?? '' }}" required><br>
                    <span><small></small></span>
                    <br>
                </div>

                <div class="rightside">
                    <label for="author">Author</label><br>
                    <input type="text" name="author" class="form-control" id="author" value="{{ $book->author ?? '' }}" required><br>
                    <span><small></small></span><br>
                    <label for="quantity">Quantity</label><br>
                    <input type="number" min="1" max="9" step="1" name="quantity" class="form-control" id="quantity" value="{{ $book->quantity ?? '' }}" required><br>
                    <span><small></small></span>
                    <br>
                </div>
            </div

            <div class="testalign">
                <div class="booktype">
                    <label for="img" style="text-align: center">Cover Image</label><br>
                    <input type="file" name="cover-image" class="form-control"><br><br>
                    <span><small></small></span><br>
                    <div>Types of Book</div>
                    <div class="container">
                        <input class="form-control" type="checkbox" onclick="toggleSelect(this)">none<br>
                        @foreach($booktypes as $id => $display)
                            <input class="form_control" type="checkbox" id="booktype_ids" name="booktype_ids[]" value="{{ $id }}" {{ (isset($bookBooktypes) && (\Illuminate\Support\Facades\DB::table('book_booktype')->where('book_id', $book->id)->where('booktype_id', $id)->get()->first() != null)) ? 'checked' : '' }}>
                            <label for="booktype_ids">{{ $display }}</label><br>
                        @endforeach
                    </div>
                    <span><small></small></span><br>
                    <label for="description">Description</label>
                    <textarea name="description"
                              class="form-control"
                              id="description"
                              placeholder="Add some description here..."
                              rows="4"
                              cols="50"
                              style="resize: none;">{{ $book->description ?? '' }}</textarea><br>
                </div>
                <span><small></small></span><br>
                <input type="submit" value="Add" onclick="alert('A new book has been added to the bookshelf!\nReturning to the bookshelf...')"></input>
            </div>
        </form>
    </x-slot:content>
</x-layouts.default-layout>
