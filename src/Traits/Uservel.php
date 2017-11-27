<?php

namespace marsoltys\uservel\Traits;

use Illuminate\Contracts\Auth\Access\Gate;
use marsoltys\uservel\Exceptions\UnauthorizedException;

if (trait_exists('\Spatie\Permission\Traits\HasRoles')) {
    trait Uservel
    {
        use hasRights;
        use \Spatie\Permission\Traits\HasRoles;
        use isSUperAdmin;
    }
} else {
    trait Uservel
    {
        use isSUperAdmin;
    }
}

trait isSUperAdmin
{
    public function isSuperAdmin()
    {
        return (bool)$this->superadmin;
    }

    protected $guard_name = 'web';
}

trait hasRights {

    /**
     * Function that syncs user roles and permissions at once. Usefull when updating user data through form.
     *
     * @param $rights array containing 'roles' and 'permission' keys with items assigned to user
     * @return $this|UnauthorizedException
     */
    public function syncRights($rights)
    {
        $user = \Auth::user();

        if ($user->can('syncRights', $user)){
            echo 'yay';
        }

        if (!empty($rights['roles'])) {
            $roles = array_filter($rights['roles']);
            $this->syncRoles($roles);
        }

        if (!empty($rights['perms'])) {
            $perms = array_filter($rights['perms']);
            $this->syncPermissions($perms);
        }

        return $this;
    }

    public function can($ability, $arguments = [])
    {
        return app(Gate::class)->forUser($this)->check($ability, $arguments);
    }

}