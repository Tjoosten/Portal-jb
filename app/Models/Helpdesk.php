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

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')
            ->withDefault(['name' => 'Onbekende gebruiker']);
    }
}
