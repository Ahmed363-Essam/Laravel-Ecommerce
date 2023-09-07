<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    //

    // return view starter page

    public function __construct()
    {
        return $this->middleware(['auth:admin']);
    }

    public function index()
    {

         return view('dashboard.index');
    }
}
