@extends('uservel::wrapper')


<?php
$data = new \Spatie\Permission\Models\Role();
$method = 'POST';
$route = route('role.store');

if (!empty($role['name'])) {
    $data = $role;
    $method = 'PUT';
    $route = route('role.update', ['role' => $data->id]);
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
                    <span id="helpBlock" class="help-block">Changing name can seriously affect permissions.</span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-md-8">
                <div class="row uservel-permissions border-left">
                    <div class="col-md-6">
                        <div><u>Assigned Permissions</u></div>
                        <br>
                        <div class="list-group assign-perms-group">
                            @foreach($data->permissions as $perm)
                                <li class="list-group-item"><span>{{ $perm->name }}</span>
                                    <div class="btn btn-warning btn-xs revoke"
                                         data-uservel-perm="{{ $perm->name }}">
                                        Revoke
                                    </div>
                                    <input type="hidden" name="perms[]" value="{{ $perm->name }}">
                                </li>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div><u>Available Permissions</u></div>
                        <br>
                        <div class="list-group revoke-perms-group">
                            @foreach($permissions as $perm)
                                <li class="list-group-item"><span>{{ $perm->name }}</span>
                                    <div class="btn btn-primary btn-xs assign"
                                         data-uservel-perm="{{ $perm->name }}">
                                        Assign
                                    </div>
                                    <input type="hidden" value="{{ $perm->name }}">
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection