<?php

namespace marsoltys\uservel\Policies;

use \User;
use Illuminate\Auth\Access\HandlesAuthorization;
use marsoltys\uservel\Traits\handlesSuperAdmin;

class UserPolicy
{
    use HandlesAuthorization;
    use handlesSuperAdmin;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \User  $user
     * @param  \User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \User  $user
     * @param  \User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \User  $user
     * @param  \User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    public function syncRights(User $user, User $model)
    {
        return $user->id !== $model->id;
    }
}
