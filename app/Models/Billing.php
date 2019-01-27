<?php

namespace App\Models;

use App\Traits\ActivityLog;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Billing
 *
 * @package App\Models
 */
class Billing extends Model
{
    use ActivityLog;

    /**
     * Mass-assign velden voor de database tabel.
     *
     * @var array
     */
    protected $fillable = ['voornaam', 'achternaam', 'groepsnaam', 'email', 'adres', 'postcode', 'stad', 'land'];

    /**
     * Data relatie voor het ophalen van de gebruiker die gekoppeld is aan de facturatie data.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
