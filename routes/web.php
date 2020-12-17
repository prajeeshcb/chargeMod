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
	//broadcast(new WebsocketDemoEvent('some data'));
    return view('chats');
});


Route::get('/chats', 'ChatController@index');
// Route::get('/messages', 'ChatController@fetchMessages');
// Route::post('/messages', 'ChatController@sendMessages');

Route::get('/authentication', 'HomeController@authentication');
Route::get('/connections', 'HomeController@connection');
Route::get('/payloads', 'ConnectionController@fetchPayloads');
Route::post('/startCharging', 'StartTransactionController@start');

Route::post('/stopCharging', 'StopTransactionController@stop');
Route::post('/bootNotification', 'BootNotificationController@bootNotification');
Route::post('/meterValue', 'MeterValueController@meterValue');
Route::post('/heartBeat', 'ConnectionController@heartbeat');
Route::get('/userdetails', 'StartTransactionController@user');


// Json files start
Route::get('download_bootreq', array('as'=> 'file.download', 'uses' => 'BootNotificationController@JSONbootreq'));
Route::get('download_bootres', array('as'=> 'file.download', 'uses' => 'BootNotificationController@JSONbootres'));
Route::get('download_authreq', array('as'=> 'file.download', 'uses' => 'HomeController@JSONauthreq'));
Route::get('download_authres', array('as'=> 'file.download', 'uses' => 'HomeController@JSONauthres'));
Route::get('download_startreq', array('as'=> 'file.download', 'uses' => 'StartTransactionController@JSONstartreq'));
Route::get('download_startres', array('as'=> 'file.download', 'uses' => 'StartTransactionController@JSONstartres'));
Route::get('download_stopreq', array('as'=> 'file.download', 'uses' => 'StopTransactionController@JSONstopreq'));
Route::get('download_stopres', array('as'=> 'file.download', 'uses' => 'StopTransactionController@JSONstopres'));
Route::get('download_meterreq', array('as'=> 'file.download', 'uses' => 'MeterValueController@JSONmeterreq'));
Route::get('download_meterres', array('as'=> 'file.download', 'uses' => 'MeterValueController@JSONmeterres'));
Route::get('download_heartbeat', array('as'=> 'file.download', 'uses' => 'ConnectionController@JSONheartbeat'));
Route::get('download_heartbeatres', array('as'=> 'file.download', 'uses' => 'ConnectionController@JSONheartbeatres'));

Route::get('download_remotestartreq', array('as'=> 'file.download', 'uses' => 'ServerController@JSONstartreq'));
Route::get('download_remotestartres', array('as'=> 'file.download', 'uses' => 'ServerController@JSONstartres'));
Route::get('download_remotestopreq', array('as'=> 'file.download', 'uses' => 'ServerController@JSONstopreq'));
Route::get('download_remotestopres', array('as'=> 'file.download', 'uses' => 'ServerController@JSONstopres'));



//Json files end


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/charge_points/{station}', 'ServerController@ChargePoints');
Route::get('/charge_point/info/{station}/{cp}', 'ServerController@ChargePointInfo');
Route::get('/server', 'ServerController@index');

Route::post('/remoteStartCharging', 'ServerController@remoteStart');
Route::post('/remoteStopCharging', 'ServerController@remoteStop');


