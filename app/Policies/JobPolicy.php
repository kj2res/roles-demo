<?php

namespace App\Policies;

use App\User;
use App\Job;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create jobs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole('manager') || $user->hasPermissionTo('create job'))
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update jobs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, Job $job)
    {
        if ($user->hasRole('admin') || $user->hasPermissionTo('approve job'))
        {
            return true;
        }
        return false;
    }
}
