<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    //
    /**
     * Récupère les offres de produits.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllOffers()
    {
        $offers = Offer::where('validated', 1)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'titre', 'type', 'description', 'price', 'updated_at']);
        
        if ($offers->isEmpty()) {
            return response()->json(['message' => 'Aucune offre disponible'], 404);
        }

        return response()->json($offers);
    }

    /**
     * Récupère une offre de produit par son ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOfferById($id)
    {
        if ($id) {
            
            $offer = Offer::where('id', $id)
                ->where('validated', 1)
                ->first(['id', 'titre', 'type', 'description', 'price', 'updated_at']);
            
            if (is_null($offer)) { 
                return response()->json(['message' => 'Offre non trouvée ou non validée'], 404);
            }
            
            return response()->json($offer);
        } else {
            return response()->json(['message' => 'ID de l\'offre doit être un nombre'], 400);
        }
    }
}
