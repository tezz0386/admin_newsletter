<?php

namespace App\Providers;

use App\Jobs\SendQueueEmail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        define('SITE_EMAIL', 'dangaura.tejendra.123@gmail.com');
        define('SITE_META_TITLE', 'News Letter');
    }
}
