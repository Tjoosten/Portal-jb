<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;

/**
 * Class NoteLease 
 * 
 * @package App\Models
 */
class NoteLease extends Model
{
    /**
     * Mass-assign fields for the database table. 
     * 
     * @return array
     */
    protected $fillable = ['title', 'beschrijving'];

    /**
     * Data relatie voor de verhurings data.
     *
     * @return BelongsTo
     */
    public function verhuring(): BelongsTo
    {
        return $this->belongsTo('lease_id');
    }

    /**
     * Data relatie voor de gegevens van de notitie autheur. 
     * 
     * @return BelongsTo
     */
    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
