<?php

namespace App;

use App\Models\{Helpdesk, Billing};
use App\Traits\ActivityLog;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

/**
 * Class User
 *
 * @package App
 */
class User extends UserRepository
{
    use Notifiable, HasRoles, SoftDeletes, ActivityLog, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'telephone_number', 'last_login_at', 'last_login_ip'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'last_login_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Determine whether when the user is online or not. 
     * 
     * @return bool
     */
    public function isOnline(): bool
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * Method for hashing the given password in the application storage. 
     * 
     * @param  string $password The given or generated password from the application/form.
     * @return void
     */
    public function setPasswordAttribute(string $password): void 
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Data relatie voor alle helpdesk tickets dat zijn aangemaakt door de gegeven gebruiker.
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Helpdesk::class, 'created_by');
    }

    /**
     * Data relatie voor de facturatie gegevens van de gebruikers. 
     * 
     * @return BelongsTo
     */
    public function billingInformation(): BelongsTo
    {
        return $this->belongsTo(Billing::class, 'billing_info');
    }

    /**
     * Get all the users that are registered on the current day.
     *
     * @param  Builder $query The Eloquent ORm query builder instance. 
     * @return Builder
     */
    public function scopeRegisteredToday($query): Builder
    {
        return $query->whereDate('created_at', now()->today());
    }
}
