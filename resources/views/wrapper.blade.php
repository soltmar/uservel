@extends(config('uservel.mainLayout'))

@section('content')
    <div class="uservel">
        <div class="container">
            @include('uservel::includes.usernav')
            @include('uservel::includes.alert')
            @yield('usercontent')
        </div>
    </div>
@endsection
