<?php
/**
 *
 * Project: uservel
 * Date: 05/10/2017
 * @author Mariusz Soltys.
 * @version 1.0.0
 * @license All Rights Reserved
 *
 */

namespace marsoltys\uservel\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use User;

class AssignmentController extends Controller
{
    public function assignRole(User $user, $roles)
    {
        $user->assignRole($roles);
    }

    public function assignPermission(User $user, $permissions)
    {
        $user->givePermissionTo($permissions);
    }

    public function assignRolePermission(Role $role, $permissions)
    {
        $role->givePermissionTo($permissions);
    }
}