<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Lease 
 * 
 * @package App\Models
 */
class Lease extends Model
{
    /**
     * Mass-assign velden voor de databank tabel. 
     * 
     * @var array
     */
    protected $fillable = [];

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
