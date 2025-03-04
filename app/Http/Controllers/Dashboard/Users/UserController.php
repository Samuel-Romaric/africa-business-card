<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    function index() {
        $users = User::where('role', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    function blockedUser($user_id) {

        // $userAut = Auth::user();

        // if ($userAut->) {
        //     # code...
        // }

        $user = User::where('id', $user_id)->first();

        if (!$user->isBlocked()) {
            $user->is_blocked = 1;
            $user->save();

            session()->flash('success', $user->getFullName() .' à été bloqué avec succès');
            return redirect()->back();
        }

        $user->is_blocked = 0;
        $user->save();

        session()->flash('success', $user->getFullName() .' à été débloqué avec succès');
        return redirect()->back();
    }
}
