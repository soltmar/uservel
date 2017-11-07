@extends('uservel::wrapper')

@section('usernav.action')
    <a href="{{ route('role.create') }}" class="btn btn-success pull-right">Add Role</a>
@endsection

@section('usercontent')
    <table class="table table-hover uservel-list">
        <thead>
        <tr>
            <th>#</th>
            <th>Role name</th>
            <th>Users assigned</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $item)
            <tr>
                <th scope="row">{{  $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->users->count() }}</td>
                <td>{{ $item->permissions }}</td>
                <td>
                    <a href="{{ route('user/role.edit', ['user' => $item->id]) }}" class="text-success">
                        <i class="fa fa-pencil" aria-hidden="true" data-uservel-id="{{ $item->id }}"
                           title="edit"></i>
                    </a>
                    &nbsp;&nbsp;
                    <a href="{{ route('user.destroy', ['user' => $item->id]) }}" class="text-danger delete">
                        <i class="fa fa-trash" aria-hidden="true" title="delete"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection