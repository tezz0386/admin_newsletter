<?php

namespace App\Console;

use App\Jobs\SendQueueEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $time;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $job = (new SendQueueEmail($this->getDetails()))
                ->delay(now()->addSeconds(1));
        $schedule->job($job)->everyFiveMinutes();;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
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
