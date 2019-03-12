<?php

namespace App\Policies;

use App\User;
use App\Models\Lease;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class LeasePolicy
 *
 * @package App\Policies
 */
class LeasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the lease.
     *
     * @param  User   $user  The entity from the authenticated user.
     * @param  Lease  $lease The given lease instance
     * @return mixed
     */
    public function update(User $user, Lease $lease)
    {
        return $user->hasRole('admin');
    }
}
