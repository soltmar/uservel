@extends('uservel::wrapper')

@can('Permission Create')
@section('usernav.action')
    <a href="{{ route('permission.create') }}" class="btn btn-success pull-right"><i
                class=" glyphicon glyphicon-plus"></i> Add Permission</a>
@endsection
@endcan

@section('usercontent')
    <table class="table table-hover uservel-list">
        <thead>
        <tr>
            <th>#</th>
            <th>Permission Name</th>
            <th>Users assigned</th>
            <th>Roles Assigned</th>
            @if(Auth::user()->can('Role Edit') || Auth::user()->can('Role Delete'))
                <th class="actions">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $item)
            <tr>
                <th scope="row">{{  $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->users->count() }}</td>
                <td>{{ $item->roles->count() }}</td>

                @if(Auth::user()->can('Permission Edit') || Auth::user()->can('Permission Delete'))
                    <td class="actions">
                        @can('Permission Edit')
                            <a href="{{ route('permission.edit', ['role' => $item->id]) }}"
                               class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil" aria-hidden="true" title="edit"></i> Edit
                            </a>
                        @endcan
                        &nbsp;&nbsp;
                        @can('Permission Delete')
                            <a href="{{ route('permission.destroy', ['role' => $item->id]) }}"
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