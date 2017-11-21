<?php

namespace marsoltys\uservel\Traits;

trait handlesSuperAdmin
{
    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
}