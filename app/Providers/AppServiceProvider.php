<?php

namespace App\Providers;

use App\User;
use App\Models\Werkpunten;
use App\Observers\{UserObserver, WerkpuntObserver};
use Spatie\BladeX\Facades\BladeX;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Model observers registration
        User::observe(UserObserver::class);
        Werkpunten::observe(WerkpuntObserver::class);

        // Blade registrations
        BladeX::component('components.*');
        BladeX::component('helpdesk.components.*');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
