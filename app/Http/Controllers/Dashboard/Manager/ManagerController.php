<?php

namespace App\Http\Controllers\Dashboard\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    function index(Request $request) {

        $type = $request->get('type');
        $is_blocked = $request->get('is_blocked');
        $search = $request->get('search');

        // Commencer la requête pour récupérer les managers
        $managersQuery = Manager::with('user')  // Nous utilisons "with" pour charger la relation user
                            ->orderBy('created_at', 'DESC');

        if (isset($type) || isset($is_blocked) || isset($search)) {
            // Filtrer par type (junior, senior ou tous)
            if ($type && $type !== 'all') {
                $managersQuery->where('type', $type);
            }
                    
            // Filtrer par statut (bloqué ou actif), ici on applique le filtre sur la table 'users'
            if ($is_blocked !== 'all') {
                $managersQuery->whereHas('user', function ($query) use ($is_blocked) {
                            $query->where('is_blocked', $is_blocked);
                });
            }
                    
            // Filtrer par recherche, sur les champs de la table 'users'
            if ($search) {
                $managersQuery->whereHas('user', function ($query) use ($search) {
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
        $managers = $managersQuery->paginate(12);

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
