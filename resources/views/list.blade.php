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
                        <i class="fa fa-trash" aria-hidden="true" title="delete"></i>
                        <i class="fa fa-pencil" aria-hidden="true" title="edit"></i>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection