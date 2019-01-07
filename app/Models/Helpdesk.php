<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActivityLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;

/**
 * Class Helpdesk 
 * 
 * @package App\Models
 */
class Helpdesk extends Model
{
    use ActivityLog;

    /**
     * Mass-assignable fields from the database table. 
     * 
     * @var array 
     */
    protected $fillable = ['titel', 'categorie', 'beschrijving'];

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
     * De relatie voor de gebruikers informatie omtrent wie het ticket heeft aangemaakt.
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')
            ->withDefault(['name' => 'Onbekende gebruiker']);
    }
}
