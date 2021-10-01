<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscriber;
use Mail;

class SentMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:sentMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send emial to all client user at same time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->getDetails();
        $subscribers = Subscriber::where('is_client', true)->orderByDesc('created_at')->get();
        foreach ($subscribers as $subscriber) {
            $data['email'] = $subscriber->email;
            Mail::send('emails.subscriber-mail',$data,function ($message) use ($data){
                $message->from($data['from']);
                $message->to($data['email']);
                $message->subject($data['subject']);
           });
        }
        return true;
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
