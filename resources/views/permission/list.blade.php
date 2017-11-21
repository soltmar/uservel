@extends('uservel::wrapper')

@section('usernav.action')
    <a href="{{ route('permission.create') }}" class="btn btn-success pull-right">Add Permission</a>
@endsection

@section('usercontent')
    <table class="table table-hover uservel-list">
        <thead>
        <tr>
            <th>#</th>
            <th>Permission Name</th>
            <th>Users assigned</th>
            <th>Roles Assigned</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $item)
            <tr>
                <th scope="row">{{  $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->users->count() }}</td>
                <td>{{ $item->roles->count() }}</td>
                <td>
                    <a href="{{ route('permission.edit', ['role' => $item->id]) }}" class="text-success">
                        <i class="fa fa-pencil" aria-hidden="true" data-uservel-id="{{ $item->id }}"
                           title="edit"></i>
                    </a>
                    &nbsp;&nbsp;
                    <a href="{{ route('permission.destroy', ['role' => $item->id]) }}" class="text-danger delete">
                        <i class="fa fa-trash" aria-hidden="true" title="delete"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection