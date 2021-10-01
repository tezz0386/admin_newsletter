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
        // $job = (new SendQueueEmail($this->getDetails()))
        //         ->delay(now()->addSeconds(1)); 
        // dispatch($job);
        
    }

    public function getDetails()
    {
        $details=array(
                'from'=>SITE_EMAIL,
                'subject'=>'This is for test to mail',
                'content'=>'This is for test to send mail to multiple subscriber as differently',
        );
        return $details;
    }
}
