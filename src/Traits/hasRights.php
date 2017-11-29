<?php

namespace marsoltys\uservel\Traits;

use Spatie\Permission\Models\Permission;

/**
 * Trait hasRights adds additional methods for maintaining / checking permissions
 *
 * @package marsoltys\uservel\Traits
 */
trait hasRights
{

    /**
     * Method that syncs user roles and permissions at once. Usefull when updating user data through form.
     *
     * @param $rights array containing 'roles' and 'permission' keys with items assigned to user
     *
     * @return $this|\Spatie\Permission\Exceptions\UnauthorizedException
     */
    public function syncRights($rights)
    {
        $user = \Auth::user();

        if ($user->can('Assign Rights')) {

            if (!empty($rights['roles'])) {
                $roles = array_filter($rights['roles']);
                $this->syncRoles($roles);
            }

            if (!empty($rights['perms'])) {
                $perms = array_filter($rights['perms']);
                $this->syncPermissions($perms);
            }
        }

        return $this;
    }


    /**
     * Overrides spatie/laravel-permission HasRole trait method to allow superAdmin role and auto-adding permissions
     *
     * @param string $permission Permission name to check
     * @param null|string $guardName Guard name against which permission is checked
     * @return bool
     */
    public function hasPermissionTo($permission, $guardName = null)
    {

        if (config('uservel.autoadd')) {
            $guard = $this->guard_name;
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guard]);
        }

        if ($this->isSuperAdmin()) {
            return true;
        }

        // Let's return spatie's original result
        return $this->parentHasPermissionTo($permission, $guardName);
    }

}