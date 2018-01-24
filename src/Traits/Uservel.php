<?php

/**
 *  User Trait used to maintain various scenarios depending on if spatie/laravel-permissions has been installed
 */

namespace marsoltys\uservel\Traits;

if (trait_exists('\Spatie\Permission\Traits\HasRoles')) {

    // If spatie/laravel-permissions has been installed

    trait Uservel
    {
        use \Spatie\Permission\Traits\HasRoles {
            hasPermissionTo as public parentHasPermissionTo;
            SpatiePermissions::hasPermissionTo insteadof \Spatie\Permission\Traits\HasRoles;
        }
        use HasSuperAdmin;
        use SpatiePermissions;
    }
} else {

    // If spatie/laravel-permissions is not installed

    trait Uservel
    {
        use HasSuperAdmin;
    }
}
