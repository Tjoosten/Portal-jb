<?php

namespace App\Policies;

use App\User;
use App\Models\Helpdesk;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class HelpdeskPolicy 
 * 
 * @package App\Policies
 */
class HelpdeskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create helpdesks.
     *
     * @param  User  $user Databank instantie van de aangemelde gebruiker. 
     * @return bool
     */
    public function viewHuurderDashboard(User $user): bool
    {
        return $user->hasRole('huurder');
    }
}
