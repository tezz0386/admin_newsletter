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
        return view('home');
    }
    public function scheduleForClient()
    {
        $subscriber = Subscriber::where('is_client', true)->first();
        return $subscriber->created_at;
    }
}
