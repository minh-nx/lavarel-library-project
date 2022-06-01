@extends('layouts.default')

@section('buttons')
<a class="btn btn-primary" href="{{ route('permissions.create') }}" role="button"><i class="fa-solid fa-plus"></i> Add New Permission</a>
@endsection

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Guard Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th class="Actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>{{ date('F d, Y', strtotime($permission->created_at)) }}</td>
                <td>{{ date('F d, Y', strtotime($permission->updated_at)) }}</td>
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
