<?php

namespace App\Http\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Jobs\SendQueueEmail;
use Carbon\Carbon;


class SubscriberController extends Controller
{
    protected $subscriber;
    function __construct(Subscriber $subscriber)
    {
        $this->middleware('auth');
        $this->subscriber = $subscriber;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function sendMail()
    {
        echo "Mail send successfully !!";
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
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
