@extends('uservel::wrapper')

@can('Role Create')
@section('usernav.action')
    <a href="{{ route('role.create') }}" class="btn btn-success pull-right"><i class=" glyphicon glyphicon-plus"></i>
        Add Role</a>
@endsection
@endcan

@section('usercontent')
    <table class="table table-hover uservel-list">
        <thead>
        <tr>
            <th>#</th>
            <th>Role name</th>
            <th>Users assigned</th>
            <th>Permissions</th>

            @if(Auth::user()->can('Role Edit') || Auth::user()->can('Role Delete'))
                <th class="actions">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $item)
            <tr>
                <th scope="row">{{  $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->users->count() }}</td>
                <td>{{ $item->permissions->count() }}</td>

                @if(Auth::user()->can('Role Edit') || Auth::user()->can('Role Delete'))
                    <td class="actions">
                        @can('Role Edit')
                            <a href="{{ route('role.edit', ['role' => $item->id]) }}" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil" aria-hidden="true" title="edit"></i> Edit
                            </a>
                        @endcan
                        &nbsp;&nbsp;
                        @can('Role Delete')
                            <a href="{{ route('role.destroy', ['role' => $item->id]) }}"
                               class="btn btn-danger delete btn-xs">
                                <i class="glyphicon glyphicon-remove" aria-hidden="true" title="delete"></i> Remove
                            </a>
                        @endcan
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection