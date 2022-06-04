@csrf

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="title">Title</label>
    <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" value="{{ $book->title ?? '' }}" required>
        <small class="form-text text-muted">
            @if ($errors->has('title'))
                <p>{{ $errors->first('title') }}</p>
            @endif
            <br>
        </small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="author">Author</label>
    <div class="col-sm-10">
        <input type="text" name="author" class="form-control" id="author" value="{{ $book->author ?? '' }}" required>
        <small class="form-text text-muted">
            @if ($errors->has('author'))
                <p>{{ $errors->first('author') }}</p>
            @endif
            <br>
        </small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="publication_year">Publication Year</label>
    <div class="col-sm-10">
        <input type="number" min="1" max="2022" step="1" name="publication_year" class="form-control" id="publication_year" value="{{ $book->publication_year ?? '' }}" required>
        <small class="form-text text-muted">
            @if ($errors->has('publication_year'))
                <p>{{ $errors->first('publication_year') }}</p>
            @endif
            <br>
        </small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="cover-image">Cover Image</label>
    <div class="col-sm-10">
        @if(isset($book->cover_image))
            <img class="form-control" width="300" height="300" alt="{{ $book->title ?? '' }}" src="{{ $book->cover_image ?? '' }}>"
        @endif
        <br>
        <input type="file" name="cover-image" class="form-control" id="cover-image">
        <small class="form-text text-muted">
            @if ($errors->has('cover_image'))
                <p>{{ $errors->first('cover_image') }}</p>
            @endif
            <br>
        </small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="description">Description</label>
    <div class="col-sm-10">
                    <textarea name="description"
                              class="form-control"
                              id="description"
                              placeholder="Add some description here..."
                              rows="4"
                              cols="50">{{ $book->description ?? '' }}</textarea>
    </div>
    <small class="form-text text-muted">
        @if ($errors->has('description'))
            <p>{{ $errors->first('description') }}</p>
        @endif
        <br>
    </small>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="quantity">Quantity</label>
    <div class="col-sm-10">
        <input type="number" min="1" max="9" step="1" name="quantity" class="form-control" id="quantity" value="{{ $book->quantity ?? '' }}" required>
        <small class="form-text text-muted">
            @if ($errors->has('quantity'))
                <p>{{ $errors->first('quantity') }}</p>
            @endif
            <br>
        </small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="booktype_ids">Book Type</label>
    <div class="col-sm-10">
        @foreach($booktypes as $id => $display)
            <input class="form_control" type="checkbox" id="booktype_ids" name="booktype_ids[]" value="{{ $id }}" {{ (isset($bookBooktypes) && (\Illuminate\Support\Facades\DB::table('book_booktype')->where('book_id', $book->id)->where('booktype_id', $id)->get()->first() != null)) ? 'checked' : '' }}>
            <label for="booktype_ids">{{ $display }}</label><br>
        @endforeach
    </div>
</div>
