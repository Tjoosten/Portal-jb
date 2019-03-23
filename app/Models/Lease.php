<?php

namespace App\Models;

use App\Repositories\CalendarRepository;
use App\Traits\ActivityLog;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Lease 
 * 
 * @package App\Models
 */
class Lease extends CalendarRepository
{
    use ActivityLog;

    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array
     */
    protected $fillable = ['start_datum', 'status', 'aantal_personen', 'eind_datum'];

    /**
     * The fields that are casted as dates.
     *
     * @var array
     */
    protected $dates = ['start_datum', 'eind_datum'];

    /**
     * Data relatie voor de huurder van het domein. 
     * 
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id')
            ->withDefault(['name' => 'Onbekende huurder']);
    }

    /**
     * Method for modifying the start datum input.
     *
     * @param  string $value
     * @return void
     */
    public function setStartDatumAttribute(string $value): void
    {
        $this->attributes['start_datum'] = $this->formatDate($value);
    }

    /**
     * Method for building the lease period attribute.
     *
     * @return string
     */
    public function getPeriodeAttribute(): string
    {
        return "{$this->start_datum->format('d/m/Y')} - {$this->eind_datum->format('d/m/Y')}";
    }

    /**
     * Method for modifying the eind datum input.
     *
     * @param  string $value
     * @return void
     */
    public function setEindDatumAttribute(string $value): void
    {
        $this->attributes['eind_datum'] = $this->formatDate($value);
    }
}
