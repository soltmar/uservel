<?php

namespace marsoltys\uservel\Traits;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait rightsInstalled {

    use AuthorizesRequests {
        AuthorizesRequests::authorize as parentAuthorize;
    }

    public $rightsInstalled = false;

    public function __construct()
    {
        $this->rightsInstalled = class_exists('\Spatie\Permission\PermissionServiceProvider');
    }

    public function authorize($ability, $arguments = [])
    {
        try {
            $this->parentAuthorize($ability, $arguments);
        } catch (AuthorizationException $e) {
            abort(403, 'You are not authorized to perform this action.');
        }
    }
}