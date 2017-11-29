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
    <br>
    <form method="POST" action="{{ $route }}">
        {{ csrf_field() }}
        {{ method_field($method) }}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                           value="{{ $data['username'] }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                           value="{{ $data['name'] }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                           value="{{ $data['email'] }}">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                           placeholder="Password">
                </div>
            </div>
        </div>

        {{-- Visible only if permissions module is installed and have parmission to assign roles / permissions --}}

        @permissions
        @can('Assign Rights')

            <h3>Permissions</h3>

            <div class="row uservel-permissions">
                <div class="col-md-3">
                    <div><u>Assigned Roles</u></div>
                    <br>
                    <div class="list-group assign-roles-group">
                        @foreach($data->getRoleNames() as $role)
                            <li class="list-group-item">
                                {{ $role }}
                                <div class="btn btn-warning btn-xs revoke" data-uservel-role="{{ $role }}">Revoke</div>
                                <input type="hidden" name="roles[]" class="role-{{ $role }}" value="{{ $role }}">
                            </li>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div><u>Available Roles</u></div>
                    <br>
                    <div class="list-group revoke-roles-group">
                        @foreach($roles as $role)
                            <li class="list-group-item">{{ $role->name }}
                                <div class="btn btn-primary btn-xs assign" data-uservel-role="{{ $role->name }}">
                                    Assign
                                </div>
                                <input type="hidden" name="roles[]" class="role-{{ $role->name }}"
                                       value="{{ $role->name }}">
                            </li>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div><u>Assigned Permissions</u></div>
                    <br>
                    <div class="list-group assign-perms-group">
                        @foreach($data->permissions as $perm)
                            <li class="list-group-item">
                                {{ $perm->name }}
                                <div class="btn btn-warning btn-xs revoke" data-uservel-perm="{{ $perm->name }}">
                                    Revoke
                                </div>
                                <input type="hidden" name="permissions[]" class="perm-{{ $perm->name }}"
                                       value="{{ $perm->name }}">
                            </li>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div><u>Available Permissions</u></div>
                    <br>
                    <div class="list-group revoke-perms-group">
                        @foreach($permissions as $perm)
                            <li class="list-group-item">{{ $perm->name }}
                                <div class="btn btn-primary btn-xs assign" data-uservel-perm="{{ $perm->name }}">
                                    Assign
                                </div>
                                <input type="hidden" name="perms[]" class="perm-{{ $perm->name }}"
                                       value="{{ $perm->name }}">
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        @endcan
        @endpermissions

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection