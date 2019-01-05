<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ActivityLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
