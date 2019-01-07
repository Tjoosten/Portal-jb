<?php

namespace App\Models;

use App\Repositories\TicketRepository;
use App\Traits\ActivityLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;

/**
 * Class Helpdesk 
 * 
 * @package App\Models
 */
class Helpdesk extends TicketRepository
{
    use ActivityLog;

    /**
     * Mass-assignable fields from the database table. 
     * 
     * @var array 
     */
    protected $fillable = ['titel', 'is_open', 'categorie', 'beschrijving', 'closed_at'];

    /**
     * The immutable date fields in the database table. 
     * 
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'closed_at'];

    /**
     * Data relatie voor de informatie omtrent de opvolger van het ticket
     *
     * @return BelongsTo
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault(['name' => '<span class="text-secondary">Niemand</span>']);
    }

    /**
     * De data relatie voor de informatie van de gebruiker die het ticket heeft gesloten. 
     * 
     * @var BelongsTo
     */
    public function closer(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault('Een administrator');
    }

    /**
     * De relatie voor de gebruikers informatie omtrent wie het ticket heeft aangemaakt.
     * 
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')
        ->withDefault(['name' => 'Onbekende gebruiker']);
    }
}
