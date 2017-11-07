@extends(config('uservel.mainLayout'))

<div class="uservel">
    <div class="container">
        @include('uservel::includes.usernav')
        @yield('usercontent')
    </div>
</div>