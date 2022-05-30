@extends('layouts.default')

@section('title', 'Home')

@section('heading')
    <h1>This is client home page</h1>
@endsection

@section('content')
    <h3>Hello {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</h3>
    <br>
    
    <a href="{{ route('books.search-page') }}">
        To search books page
    </a>
    <br><br>

    <a href="{{ route('books.borrows.index') }}">
        To borrow history
    </a>
@endsection