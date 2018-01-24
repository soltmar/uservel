<?php

namespace marsoltys\uservel\Traits;

/**
 * Trait isSUperAdmin adds possibility to check if user is super admin
 *
 * @package marsoltys\uservel\Traits
 */
trait HasSuperAdmin
{
    public function isSuperAdmin()
    {
        return (bool)$this->superadmin;
    }

    protected $guard_name = 'web';
}