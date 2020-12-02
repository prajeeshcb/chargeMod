<?php

use Illuminate\Support\Facades\Route;
use App\Events\WebsocketDemoEvent;
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
	broadcast(new WebsocketDemoEvent('some data'));
    return view('welcome');
});
Route::get('/chats', 'ChatController@index');
Route::get('/messages', 'ChatController@fetchMessages');
Route::post('/messages', 'ChatController@sendMessages');

Route::get('/authentication', 'HomeController@authentication');
Route::get('/connections', 'HomeController@connection');
Route::get('/payloads', 'ConnectionController@fetchPayloads');
Route::post('/startCharging', 'StartTransactionController@start');
Route::post('/stopCharging', 'StopTransactionController@stop');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
