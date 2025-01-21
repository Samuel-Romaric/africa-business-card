<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralManagerController extends Controller
{
    //
    function index() {
        return view('admin.dashboard');
    }
}
