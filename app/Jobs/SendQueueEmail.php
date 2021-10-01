<?php

namespace App\Jobs;

use App\Models\Subscriber;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $tries = 25;
    public $maxExceptions = 4;
    public $timeout = 14400; // 4 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
   public function handle()
    {
        $data = $this->details;
        $subscribers = Subscriber::where('is_client', true)->orderByDesc('created_at')->get();
        foreach ($subscribers as $subscriber) {
            $data['email'] = $subscriber->email;
            Mail::send('emails.subscriber-mail',$data,function ($message) use ($data){
                $message->from($data['from']);
                $message->to($data['email']);
                $message->subject($data['subject']);
           });
        }
        $this->release();
    }
}