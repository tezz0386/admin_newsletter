<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $time;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $subscriber = Subscriber::where('is_client', true)->first();
        // $this->time = $this->scheduleForClient();
        // $time = '"0 0 8 '.$this->time->month.' '.$this->time->month.'/4'. ' ? '. '2020-299"';
        // return $time;

        // $subscriber = Subscriber::find(1);
        // $date = $subscriber->created_at;
        // $newDate = Carbon::now()->toDateString();

        // if($date->addDay(5)->toDateString() == $newDate){
        //     $subscriber->sent_time = Carbon::now();
        //     $subscriber->save();
        //     return "Equal date";
        // }else{
        //     return "Not Equal Date";
        // }

        return view('home');

    }
    public function scheduleForClient()
    {
        $subscriber = Subscriber::where('is_client', true)->first();
        return $subscriber->created_at;
    }



    public function sendEmailToAll()
    {
        $subscribers = Subscriber::orderByDesc('created_at')->get();
        foreach ($subscribers as $subscriber) {
           
        }
    }
}
