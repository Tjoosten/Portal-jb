<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CalendarRepository
 */
class CalendarRepository extends Model
{
    /**
     * Method to create date format.
     *
     * @param  string $date The given date in the Application
     * @return string
     */
    protected function formatDate(string $date): string
    {
        return now()->createFromFormat('Y-m-d', $date);
    }

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