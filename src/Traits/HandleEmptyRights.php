<?php
/**
 *
 * Project: ecmsl55
 * Date: 12/12/2017
 * @author Mariusz Soltys.
 * @version 1.0.0
 * @license All Rights Reserved
 *
 */

namespace marsoltys\uservel\Traits;

use Illuminate\Http\Request;

trait HandleEmptyRights
{
    public function handleEmptyRight(Request $request)
    {
        if (count($request->perms) > 1) {
            $request->perms = array_filter($request->perms);
        }

        if (empty($request->perms)) {

            $request->perms = [];
        }

        if (count($request->roles) > 1) {
            $request->roles = array_filter($request->roles);
        }

        if (empty($request->roles)) {

            $request->roles = [];
        }

        return $request;
    }
}