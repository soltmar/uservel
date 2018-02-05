@extends('uservel::wrapper')

@can('User.Create')
@section('usernav.action')
    <a href="{{ route('user.create') }}" class="btn btn-success pull-right"><i class=" glyphicon glyphicon-plus"></i>
        New User</a>
@endsection
@endcan

@section('usercontent')
    <table class="table table-hover uservel-list">
        <thead>
        <tr>
            <th>#</th>
            @foreach(config('uservel.displayProperties') as $heading)
                <th>{{ $heading }}</th>
            @endforeach
            @if(Auth::user()->can('User.Update') || Auth::user()->can('User.Delete'))
                <th class="actions">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($users as $item)
            <tr>
                <th scope="row" class="tbl-row-no"></th>
                @foreach(config('uservel.displayProperties') as $property)
                    <td>{{ $item->$property }}</td>
                @endforeach

                @if(Auth::user()->can('User.Update') || Auth::user()->can('User.Delete'))
                    <td class="actions">
                        @can('User.Update')
                            <a href="{{ route('user.edit', ['user' => $item->id]) }}" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil" aria-hidden="true" title="edit"></i> Edit
                            </a>
                        @endcan
                        @can('User.Delete')
                            &nbsp;&nbsp;
                            <a href="{{ route('user.destroy', ['user' => $item->id]) }}"
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