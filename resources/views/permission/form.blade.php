@extends('uservel::wrapper')


<?php
$data = new \Spatie\Permission\Models\Permission();
$method = 'POST';
$route = route('permission.store');

if (!empty($permission['name'])) {
    $data = $permission;
    $method = 'PUT';
    $route = route('permission.update', ['role' => $data->id]);
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
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $data['name'] }}">
                    <span id="helpBlock" class="help-block">Changing name can seriously affect application permissions.</span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection