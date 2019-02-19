<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CalendarRepository
 */
class CalendarRepository extends Model
{
    /**
     * Method for getting all the possible leases statusses for the create form.
     *
     * @return array
     */
    public function getLeaseStatusses(): array
    {
        return ['nieuwe aanvraag' => 'nieuwe aanvraag', 'optie' => 'optie', 'bevestigd' => 'bevestigd'];
    }
}