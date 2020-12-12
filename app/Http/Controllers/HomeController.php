<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChargingStation;
class HomeController extends Controller
{
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
        $stations = ChargingStation::get();
        return view('server', compact('stations'));
    }

   /* public function authentication()
    {
        return view('profile');
    }
    public function connection()
    {
        return view('chats');
    }*/
}
