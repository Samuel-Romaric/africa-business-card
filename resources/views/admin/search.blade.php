<?php

public function searchUsers(Request $request)
{
    $secteurId = $request->input('secteur_id');
    $searchTerm = $request->input('search'); // Nom, prénom, téléphone, etc.
    $isManager = $request->input('is_manager'); // Filtre pour les managers

    $users = User::query()
        ->when($secteurId, function ($query, $secteurId) {
            return $query->where('secteur_activite_id', $secteurId);
        })
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->where('nom', 'LIKE', "%$searchTerm%")
                  ->orWhere('prenom', 'LIKE', "%$searchTerm%")
                  ->orWhere('telephone', 'LIKE', "%$searchTerm%")
                  ->orWhereDate('created_at', $searchTerm); // Pour chercher par date
            });
        })
        ->when($isManager, function ($query) {
            return $query->whereHas('subordinates'); // Vérifie si l'utilisateur est un manager
        })
        ->get();

    return response()->json($users);
}
