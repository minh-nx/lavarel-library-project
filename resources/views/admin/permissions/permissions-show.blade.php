@extends('layouts.default')

@section('title', 'Admin Home')

@section('heading')
    <h1>This is permission show page</h1>
@endsection

@section('content')
    <dl class="row">
        <dt class="col-sm-3">Permission ID</dt>
        <dd class="col-sm-9">{{ $permission->id }}</dd>

        <dt class="col-sm-3">Permission Name</dt>
        <dd class="col-sm-9">{{ $permission->name }}</dd>

        <dt class="col-sm-3">User ID</dt>
        <dd class="col-sm-9">{{ $permission->id }}</dd>

        <dt class="col-sm-3">User Name</dt>
        <dd class="col-sm-9">{{ $permission->username }}</dd>
    </dl>
@endsection
