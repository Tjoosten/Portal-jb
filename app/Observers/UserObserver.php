<?php

namespace App\Observers;

use App\User;
use App\Models\Billing;

/**
 * Class UserObserver
 *
 * @package App\Observers
 */
class UserObserver
{
    /**
     * Handle the user "created" event.
     * ----
     * Implement check and method for storing the basic billing information on tenant accounts.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user): void
    {
        $billing = new Billing(['email' => $user->email]);
        $user->billingInformation()->save($billing);
    }
}
