<?php

namespace marsoltys\uservel\Traits;

use Illuminate\Http\Request;

trait HandleEmptyRights
{
    /**
     * Handles case where all either roles or perms revoked
     *
     * @param Request $request
     * @return Request
     */
    public function handleEmptyRight(Request $request)
    {
        if (! empty($request->perms)) {
            $request->perms = array_filter($request->perms);
        }

        if (empty($request->perms)) {

            $request->perms = [];
        }

        if (! empty($request->roles) && count($request->roles) >= 1) {
            $request->roles = array_filter($request->roles);
        }

        if (empty($request->roles)) {

            $request->roles = [];
        }

        return $request;
    }
}