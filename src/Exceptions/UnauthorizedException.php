<?php
/**
 *
 * Project: ecmsl55
 * Date: 21/11/2017
 * @author Mariusz Soltys.
 * @version 1.0.0
 * @license All Rights Reserved
 *
 */

namespace marsoltys\uservel\Exceptions;


if (class_exists('\Spatie\Permission\Exceptions\UnauthorizedException')) {

    class UnauthorizedException extends \Spatie\Permission\Exceptions\UnauthorizedException
    {
        use forSuperAdmin;
    }
} else {
    class UnauthorizedException
    {
        use forSuperAdmin;
    }
}

trait forSuperAdmin
{
    public static function forSuperAdmin(): self
    {
        return new static(403, 'You must have SuperAdmin rights to perform this action.', null, []);
    }

    public static function forSelf(): self
    {
        return new static(403, 'You are not allowed to perform this action on yourself.', null, []);
    }
}

