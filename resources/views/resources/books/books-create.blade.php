@extends('layouts.default')

@section('title', 'Create Book')

@section('heading')
    <h1>This is book create page</h1>
@endsection

@section('content')
    <div class="col">
        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="title">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="title" required>
                    <small class="form-text text-muted">The title of the book.</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="author">Author</label>
                <div class="col-sm-10">
                    <input type="text" name="author" class="form-control" id="author" required>
                    <small class="form-text text-muted">The author of the book.</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="pub_year">Publication Year</label>
                <div class="col-sm-10">
                    <input type="number" min="1" max="2022" step="1" name="pub_year" class="form-control" id="pub_year" required>
                    <small class="form-text text-muted">The year when the book first released.</small>
                </div>
            </div>

{{--            <div class="form-group row">--}}
{{--                <label class="col-sm-2 col-form-label"for="image">Cover Image</label>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <input type="file" name="image" class="form-control" id="image" required>--}}
{{--                    <small class="form-text text-muted">Select a file to import.</small>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="description">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" id="description" placeholder="Add some description here..." rows="4" cols="50">
                    </textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="quantity">Quantity</label>
                <div class="col-sm-10">
                    <input type="number" min="1" max="9" step="1" name="quantity" class="form-control" id="quantity" required>
                    <small class="form-text text-muted">The number of available books.</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="booktype_ids">Book Type</label>
                <div class="col-sm-10">
                    <select name="booktype_ids[]" class="form-control" id="booktype_ids" multiple>
                        @foreach($booktypes as $id => $display)
                            <option value="{{ $id }}">{{ $display }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">The book types of the book.</small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <div class="col-sm-9">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
