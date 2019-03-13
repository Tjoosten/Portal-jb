<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider 
 * 
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\User::class                    => \App\Policies\UserPolicy::class,
        \App\Models\Lokalen::class          => \App\Policies\LokalenPolicy::class,
        \App\Models\Helpdesk::class         => \App\Policies\HelpdeskPolicy::class,
        \App\Models\Lease::class            => \App\Policies\LeasePolicy::class,
        \App\Models\NoteLease::class        => \App\Policies\NotePolicy::class,
        \BeyondCode\Comments\Comment::class => \App\Policies\CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
