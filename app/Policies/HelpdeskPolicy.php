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
     * Determine whether the user can view the helpdesk ticket or not. 
     *
     * @param  User     $user   De databank entity van de aangemelde gebruiker. 
     * @param  Helpdesk $ticket De databank entity van het helpdesk ticket.  
     * @return bool
     */
    public function viewTicket(User $user, Helpdesk $ticket): bool 
    {
        return $user->id === $ticket->created_by || $user->hasRole('admin');
    }

    /**
     * Determine whether the authenticated user can create an helpdesk ticket or not. 
     * 
     * @param  User $user The database entity from the authenticated user. 
     * @return bool
     */
    public function store(User $user): bool 
    {
        return $user->hasAnyRole(['admin', 'huurder']);
    }

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
