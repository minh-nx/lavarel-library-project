@extends('layouts.default')

@section('title', 'Create Permissions')

@section('heading')
    <h1>This is permission index page</h1>
@endsection

@section('buttons')
<a class="btn btn-primary" href="{{ route('permissions.create') }}" role="button"><i class="fa-solid fa-plus"></i> Add New Permission</a>
@endsection

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>Permission Id</th>
            <th>Permission Name</th>
            <th>User Id</th>
            <th>User Name</th>
            <th class="Actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->username }}</td>
                <td class="actions">
                    <a
                        href="{{ route('permissions.show', ['permission' => $permission->id]) }}"
                        alt="View"
                        title="View">
                        <i class="fa-solid fa-eye"></i> View
                    </a>

                    &nbsp;&nbsp;

                    <a
                        href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                        alt="Edit"
                        title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                </td>
            </tr>
        @empty
        @endforelse
        </tbody>
    </table>
@endsection
