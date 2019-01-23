<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
