<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StationMessageController extends Controller
{
    public function index()
    {
        return view('pages/stationmessages/index');
    }
}
