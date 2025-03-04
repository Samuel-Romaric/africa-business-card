<?php

namespace App\Http\Controllers\Dashboard\Commerciaux;

use App\Http\Controllers\Controller;
use App\Models\ActivitySector;
use App\Models\Commercial;
use App\Models\User;
use Illuminate\Http\Request;

class CommerciauxController extends Controller
{
    //
    function showAllCommerciaux() {
        $commerciaux = Commercial::orderBy('created_at', 'DESC')->paginate(12);
        $activitySector = ActivitySector::all()->pluck('id', 'titre');
        
        return view('admin.commerciaux.index', compact('commerciaux', 'activitySector'));
    }

    function blockedCommercial($user_id) {
        if (!is_null($user_id)) {
            $user = User::where('id', $user_id)->first();

            if ($user->isBlocked()) {
                $user->update([
                    'is_blocked' => 0,
                ]);
                
                session()->flash('success', $user->name .' à été débloqué avec succès');
                return redirect()->back();
            }

            $user->update([
                'is_blocked' => 1,
            ]);
            
            session()->flash('success', $user->name .' à été bloqué avec succès');
            return redirect()->back();
        }
    }

    function showCommercial($user_id) {
        if (!is_null($user_id)) {
            $user = User::where('id', $user_id)->first();

            if ($user) {
                return view('admin.commerciaux.show', compact('user'));
            }

            session()->flash('error','Rééssayé plus tard, une erreur s\'est produite');
            return redirect()->back();
        }
    }
}
