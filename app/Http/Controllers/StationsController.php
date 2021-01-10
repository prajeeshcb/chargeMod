<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StationsController extends Controller
{
    public function index()
    {
        return view('pages/stations/index');
    }
}
