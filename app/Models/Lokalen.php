<?php

namespace App\Models;

use App\Traits\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use App\User;

/**
 * Class Lokalen
 * 
 * @package App\Models
 */
class Lokalen extends Model
{
    use ActivityLog;

    /**
     * Attributes that are mass-assignable to the database table. 
     * 
     * @var array
     */
    protected $fillable = ['name', 'capacity', 'capacity_type'];

    /**
     * Data relatie voor de werkpunten aan een lokaal. 
     * 
     * @return HasMany
     */
    public function werkpunten(): HasMany 
    {
        return $this->hasMany(Werkpunten::class);
    }

    /**
     * Data relatie voor de verantwoordelijke van een lokaal.
     * 
     * @return BelongsTo
     */
    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verantwoordelijke')
            ->withDefault(['name' => '<span class="text-secondary">-</span>']);
    }
}
