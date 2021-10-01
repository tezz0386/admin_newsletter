<?php

use App\Http\Admin\SubscriberController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');


Route::group(['prefix'=>'admin', 'middleware'=>'role:admin'], function(){
	Route::get('/', [HomeController::class, 'index']);
	Route::get('/home', [HomeController::class, 'index'])->name('admin.dashboard');
	Route::post('/home/test-mail', [SubscriberController::class, 'sendMail'])->name('test-mail');
});
