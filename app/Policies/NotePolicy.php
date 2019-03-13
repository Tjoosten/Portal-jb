<?php

namespace App\Policies;

use App\User;
use App\Models\NoteLease;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class NotePolicy
 *
 * @package App\Policies
 */
class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the note lease.
     *
     * @param  User       $user         De databank entiteit van de geauthenticeerde gebruiker.
     * @param  NoteLease  $noteLease    De databank entiteit van de notitie.
     * @return bool
     */
    public function update(User $user, NoteLease $noteLease): bool
    {
        return $user->is($noteLease->auteur);
    }

    /**
     * Determine whether the user can delete the note lease.
     *
     * @param  User       $user         De databank entiteit van de geauthenticeerde gebruiker.
     * @param  NoteLease  $noteLease    De databank entiteit van de notitie.
     * @return bool
     */
    public function delete(User $user, NoteLease $noteLease): bool
    {
        return $user->is($noteLease->auteur);
    }
}
