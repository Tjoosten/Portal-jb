<?php

namespace App\Policies;

use App\User;
use BeyondCode\Comments\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CommentPolicy 
 * 
 * @package App\Policies
 */
class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the comment or not. 
     * 
     * @param  User    $user    De databank entiteit van de aangemelde gebruiker. 
     * @param  Comment $comment De databank entiteit van de comment in de applicatie. 
     * @return bool 
     */
    public function edit(User $user, Comment $comment): bool 
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Bepaal of de aangemelde gebruiker de comment kan verwijderen of niet. 
     * 
     * @param  User    $user    De databank entiteit van de aangemelde gebruiker.   
     * @param  Comment $comment De databank entiteit van de comment in de applicatie
     * @return bool
     */
    public function destroy(User $user, Comment $comment): bool 
    {
        return $user->id === $comment->user_id;
    }
}
