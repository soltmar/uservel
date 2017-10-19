@extends(config('uservel.mainLayout'))

@section('content')
    <div class="container">
        <table class="table table-hover uservel-list">
            <thead>
            <tr>
                <th>#</th>
                @foreach(config('uservel.displayProperties') as $heading)
                    <th>{{ $heading }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
                <tr>
                    <th scope="row">{{  $loop->iteration }}</th>
                    @foreach(config('uservel.displayProperties') as $property)
                        <td>{{ $item->$property }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route('user.edit', ['user' => $item->id]) }}" >
                            <i class="fa fa-pencil" aria-hidden="true" data-uservel-id="{{ $item->id }}" title="edit"></i>
                        </a>
                        <a href="{{ route('user.destroy', ['user' => $item->id]) }}" >
                            <i class="fa fa-trash" aria-hidden="true" title="delete"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('uservel::modal')
@endsection