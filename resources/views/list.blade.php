@extends(config('uservel.mainLayout'))

@section('content')
    <div class="uservel">
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
                            <a href="{{ route('user.edit', ['user' => $item->id]) }}" class="text-success">
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
        </div>
        @include('uservel::modal')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
                $('.uservel .delete').on('click', function (e) {
                    e.preventDefault();
                    if (confirm('Do you really want to delete this user?')) {
                        var link = this.href;
                        $.ajax({
                            method: 'DELETE',
                            url: link
                        })
                            .done(function () {
                                location.reload();
                            });
                    }
                });
            });
        </script>
    </div>
@endsection