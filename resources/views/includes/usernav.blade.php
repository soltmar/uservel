<br>
<div class="btn-group user-nav" role="group" aria-label="User Navigation">
    <a href="{{ route('user.index') }}" class="btn btn-default">List Users</a>
    {{-- Check if permission module is installed--}}
    @if(class_exists('\Spatie\Permission\PermissionServiceProvider'))
        <a href="{{ route('role.index') }}" class="btn btn-default">Roles</a>
        <a  href="{{ route('permission.index') }}" class="btn btn-default">Permissions</a>
    @endif
</div>
@yield('usernav.action')
<br>
<br>