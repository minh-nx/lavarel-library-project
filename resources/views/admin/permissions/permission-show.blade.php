@extends('layouts.default')

@section('title', 'Admin Home')

@section('heading')
    <h1>This is permission show page</h1>
@endsection

@section('content')
    <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">{{ $permission->id }}</dd>

        <dt class="col-sm-3">Name</dt>
        <dd class="col-sm-9">{{ $permission->name }}</dd>

        <dt class="col-sm-3">Guard Name</dt>
        <dd class="col-sm-9">{{ $permission->guard_name }}</dd>

        <dt class="col-sm-3">Created At</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($permission->created_at)) }}</dd>

        <dt class="col-sm-3">Updated At</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($permission->updated_at)) }}</dd>
    </dl>
@endsection
