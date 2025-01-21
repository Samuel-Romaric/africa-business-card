<?php

namespace App\Http\Controllers\Dashboard\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    function index() {
        $managers = Manager::orderBy('created_at')->paginate(6);

        return view('admin.manager.index', compact('managers'));
    }
}
