@extends('layouts.default')

@section('title', 'Admin Home')

@section('heading')
    <h1>This is admin home page</h1>
@endsection

@section('content')
    <h3>Hello admin {{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</h3>
    <br>

    <a href="{{ route('home') }}">
        To user page
    </a>
    <br><br>

    <a href="{{ route('books.index') }}">
        List books
    </a>
    <br><br>

    <a href="{{ route('admin.books.borrows.index') }}">
        Borrowing History
    </a>
    <br><br>

    @can('permissions.manage')
        <a href="{{ route('permissions.index') }}">
            Manage Permissions
        </a>
    @endcan
    <br><br>
@endsection
