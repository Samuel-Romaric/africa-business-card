<?php

namespace App\Http\Controllers\Dashboard\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    function index() {
        $managers = Manager::orderBy('created_at', 'DESC')->paginate(12);

        return view('admin.manager.index', compact('managers'));
    }

    function showManager($user_id) {
        
        if (!is_null($user_id)) {
            $user = User::where('id', $user_id)->first();

            return view('admin.manager.show', compact('user'));
        }
        
    }

    function blockedManager($user_id) {

        if (!is_null($user_id)) {
            $user = User::where('id', $user_id)->first();

            if (!$user->isBlocked()) {
                $user->is_blocked = 1;
                $user->save();

                session()->flash('success', $user->name .' à été bloqué avec succès');
                return redirect()->back();
            }

            $user->is_blocked = 0;
            $user->save();

            session()->flash('success', $user->name .' à été débloqué avec succès');
            return redirect()->back();
        }
    }
}
