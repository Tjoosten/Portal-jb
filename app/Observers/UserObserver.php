<?php

namespace App\Observers;

use App\Notifications\Users\CreatedMail;
use App\User;

/**
 * Class UserObserver
 *
 * @package App\Observers
 */
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  User  $user De entiteit van de aangemaakte gebruiker.
     * @return void
     */
    public function created(User $user)
    {
        $password = str_random(15);

        if ($user->update(['password' => $password])) { // Het wachtwoord voor de nieuwe gebruiker is aangepast in de databank.
            $when = now()->addMinute();
            $user->notify((new CreatedMail($password))->delay($when));
        }
    }
}
