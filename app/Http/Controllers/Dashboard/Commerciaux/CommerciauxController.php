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
    function showAllCommerciaux(Request $request) {
        
        $type = $request->get('type');
        $is_blocked = $request->get('is_blocked');
        $search = $request->get('search');
        $activity_sector_id = (int) $request->get('activity_sector');

        $commerciauxQuery = Commercial::with('user')  // Nous utilisons "with" pour charger la relation user
                            ->orderBy('created_at', 'DESC');

        if (isset($type) || isset($is_blocked) || isset($search) || isset($activity_sector)) {
            
            if ($type && $type !== 'all') {
                $commerciauxQuery->where('type', $type);
            }

            // Filtrer par statut (bloqué ou actif), ici on applique le filtre sur la table 'users'
            if ($is_blocked !== 'all') {
                $commerciauxQuery->whereHas('user', function ($query) use ($is_blocked) {
                    $query->where('is_blocked', $is_blocked);
                });
            }
            
            // Filtrer par secteur d'activité
            if ($activity_sector_id && $activity_sector_id !== 'all') {
                $commerciauxQuery->whereHas('user', function ($query) use ($activity_sector_id) {
                    $query->where('activity_sector_id', $activity_sector_id);
                });
            }

            // Filtrer par recherche, sur les champs de la table 'users'
            if ($search) {
                $commerciauxQuery->whereHas('user', function ($query) use ($search) {
                    $query->where('firstname', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('slug', 'like', "%$search%")
                        ->orWhere('num_cni', 'like', "%$search%")
                        ->orWhere('date_naissance', 'like', "%$search%")
                        ->orWhere('code', 'like', "%$search%")
                        ->orWhere('telephone', 'like', "%$search%")
                        ->orWhere('whatsapp', 'like', "%$search%")
                        ->orWhere('diplome', 'like', "%$search%")
                        ->orWhere('pays', 'like', "%$search%")
                        ->orWhere('departement', 'like', "%$search%")
                        ->orWhere('ville', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
            }
        }

        // Paginer les résultats avec les filtres appliqués
        $commerciaux = $commerciauxQuery->paginate(12);
        // $activitySector = ActivitySector::all()->pluck('id', 'titre');
        
        return view('admin.commerciaux.index', compact('commerciaux'));
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
