<?php

namespace App\Console;

use App\Jobs\SendQueueEmail;
use App\Jobs\SubscriberJob;
use App\Models\Subscriber;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

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
        $job1 = (new SendQueueEmail($this->getDetails()));
        // $job2 = (new SubscriberJob($this->getDetails()))->cron();
        $this->time = $this->scheduleForClient();
        $time = '0 0 8 '.$this->time->month.' '.$this->time->month.'/4'. ' ? '. '2020-2099';
        $schedule->job($job1)->quarterly();
        // $schedule->job($job2);
        // $schedule->command('queue:work', ['--tries'=>5])->everyMinute();
        // $schedule->command('inspire')->hourly();
        // dispatch($job);
        // $schedule->job(new SendQueueEmail($this->getDetails()));
        // $schedule->job($job);



        // ("0 15,16 * * *")



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
    public function scheduleForClient()
    {
        $subscriber = Subscriber::where('is_client', true)->first();
        return $subscriber->created_at;
    }
}
