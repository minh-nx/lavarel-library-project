@extends('layouts.default')

@section('content')
    <div class="col">
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="user_id">Username</label>
                <div class="col-sm-10">
                    <select name="user_id" class="form-control" id="user_id" required>
                        @foreach($users as $id => $display)
                            <option value="{{ $id }}">{{ $display }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">The current selected user.</small>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"for="permission_id">Permission</label>
                <div class="col-sm-10">
                    <select name="permission_id" class="form-control" id="permission_id" required>
                        @foreach($permissions as $id => $display)
                            <option value="{{ $id }}">{{ $display }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">The permission being assigned to the user.</small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
                <div class="col-sm-9">
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
