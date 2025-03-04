<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralManagerController extends Controller
{
    //
    function index() {
        return view('admin.dashboard');
    }
}
