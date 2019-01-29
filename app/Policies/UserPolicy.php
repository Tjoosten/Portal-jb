<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 *
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user is the same as the given user.
     *
     * @param  User  $authUser  The authenticated user entity.
     * @param  User  $userModel The user entity given from the users model.
     * @return bool
     */
    public function sameUser(User $authUser, User $userModel): bool
    {
        return $authUser->id === $userModel->id;
    }

    /**
     * Determine whether the user is permitted to remove a user lock in the application. 
     * 
     * @param  User $authUser   The authenticated user entity.
     * @param  User $userModel  The user entity from the given user
     * @return bool
     */
    public function removeLock(User $authUser, User $userModel): bool 
    {
        return $authUser->hasRole('admin') && $userModel->isBanned();
    }

    /**
     * Determine whether the authenticated user can create a new user of not.
     *
     * @param  User $authUser   The authenticated user entity
     * @return bool
     */
    public function store(User $authUser): bool
    {
        return $authUser->hasRole('admin');
    }
}
