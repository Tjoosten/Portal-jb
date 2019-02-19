<?php

namespace App\Models;

use App\Repositories\CalendarRepository;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Lease 
 * 
 * @package App\Models
 */
class Lease extends CalendarRepository
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array
     */
    protected $fillable = [];

    protected $dates = ['start_datum', 'eind_datum'];

    /**
     * Data relatie voor de huurder van het domein. 
     * 
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
