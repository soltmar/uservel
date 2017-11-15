@extends('uservel::wrapper')


<?php
$data = new \User();
$method = 'POST';
$route = route('user.store');

if (!empty($user['id'])) {
    $data = $user;
    $method = 'PUT';
    $route = route('user.update', ['user' => $data->id]);
}
?>

@section('usercontent')
        <h3>{{ $title }}</h3>
        <form method="POST" action="{{ $route }}">
            {{ csrf_field() }}
            {{ method_field($method) }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ $data['username'] }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $data['name'] }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $data['email'] }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Password">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@endsection