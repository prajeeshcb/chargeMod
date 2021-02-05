<?php

use Illuminate\Support\Facades\Route;
use App\Events\WebsocketDemoEvent;
use App\Http\Controllers\CustomerController;
use App\ConnectorType;
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
Route::get('getConnectors', 'HomeController@getConnectors');
Route::get('getChargepoints', 'HomeController@getChargepoints');

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





//Json files end
Route::get('/login', function () {
//    return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/charge_points/{station}', 'ServerController@ChargePoints');
	Route::get('/charge_point/info/{station}/{cp}', 'ServerController@ChargePointInfo');
	Route::get('/server', 'ServerController@index');

	Route::post('/remoteStartCharging', 'ServerController@remoteStart');
	Route::post('/remoteStopCharging', 'ServerController@remoteStop');

	// db tables starts
	Route::get('/connector','ConnectorTypeController@index');
	Route::get('/addconnector','ConnectorTypeController@create');
	Route::post('saveconnector','ConnectorTypeController@store');
	Route::get('/connector/edit/{id}','ConnectorTypeController@show');
	Route::post('/connector/update/{id}','ConnectorTypeController@update');
	Route::get('/connector/delete/{id}','ConnectorTypeController@destroy');
	Route::get('/searchconnector','ConnectorTypeController@search_connector');
	Route::get('/addCP','ChargePointController@create');
	
	Route::get('/CP','ChargePointController@index');
	Route::post('saveCP','ChargePointController@store');
	Route::get('/CP/edit/{id}','ChargePointController@show');
	Route::post('/CP/update/{id}','ChargePointController@update');
	Route::get('/CP/delete/{id}','ChargePointController@destroy');
	Route::get('/CP/details/{id}','ChargePointController@details');
	Route::get('/searchCP','ChargePointController@search_CP');
	Route::get('/CP/messages/{id}', 'StationMessageController@cpMessages');

	Route::get('/reservation','ReservationController@index');
	Route::get('/addreservation','ReservationController@create');
	Route::post('savereservation','ReservationController@store');
	Route::get('/reservation/edit/{id}','ReservationController@show');
	Route::post('/reservation/update/{id}','ReservationController@update');
	Route::get('/reservation/delete/{id}','ReservationController@destroy');
	Route::get('/transaction','TransactionController@index');
	Route::get('/addtransaction','TransactionController@create');
	Route::post('savetransaction','TransactionController@store');
	Route::get('/transaction/edit/{id}','TransactionController@show');
	Route::post('/transaction/update/{id}','TransactionController@update');
	Route::get('/transaction/delete/{id}','TransactionController@destroy');
	Route::get('/energydetails','EnergyDetailsController@index');
	Route::get('/addenergydetails','EnergyDetailsController@create');
	Route::post('saveenergydetails','EnergyDetailsController@store');
	Route::get('/energydetails/edit/{id}','EnergyDetailsController@show');
	Route::post('/energydetails/update/{id}','EnergyDetailsController@update');
	Route::get('/energydetails/delete/{id}','EnergyDetailsController@destroy');
	Route::get('/customer','CustomerController@index');
	Route::get('/addcustomer','CustomerController@create');
	Route::post('savecustomer','CustomerController@store');
	Route::get('/customer/edit/{id}','CustomerController@show');
	Route::post('/customer/update/{id}','CustomerController@update');
	Route::get('/customer/delete/{id}','CustomerController@deactivate');
	Route::get('/searchuser','CustomerController@search_user');
	Route::get('/stations','StationsController@index');
	Route::get('/messages','StationMessageController@index');
	Route::get('/list/messages', 'StationsController@listMsgs');
	
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/charge_points/{station}', 'ServerController@ChargePoints');
Route::get('/charge_point/info/{station}/{cp}', 'ServerController@ChargePointInfo');
Route::get('/server', 'ServerController@index');

Route::post('/remoteStartCharging', 'ServerController@remoteStart');
Route::post('/remoteStopCharging', 'ServerController@remoteStop');

;

// db tables ends


