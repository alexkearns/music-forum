<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('production')) {
            $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
            $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
            Bugsnag::setNotifyReleaseStages(['production']);
        }
    }
}
