<?php

namespace App\Http\Controllers\Dashboard\Business\Offer;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class OfferControler extends Controller
{
    //
    function showOffers(Request $request, $item_id, $slug) {
        
        $business = Business::where('id', $item_id)->where('slug', $slug)->first();

        if (is_null($business)) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        // Récupérer les filtres de la requête
        $type = $request->get('type');
        $validated = $request->get('validated');
        $search = $request->get('search');
        
        // Commencer la requête pour récupérer les offres
        $offersQuery = $business->offers();

        if (isset($type) || isset($validated) || isset($search)) {

            // Filtrer par type (produit ou service)
            if (!empty($type) && $type !== 'all') {
                $offersQuery->where('type', $type);
            }

            // Filtrer par statut (validé ou en attente)
            if ($validated !== 'all') {
                $offersQuery->where('validated', $validated);
            }

            // Filtrer par texte de recherche (par exemple, sur le titre ou la description de l'offre)
            if (!empty($search)) {
                $offersQuery->where(function ($query) use ($search) {
                    $query->where('titre', 'like', "%$search%")
                        ->orWhere('price', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
            }
        }

        // Récupérer les offres paginées avec les filtres appliqués
        $offers = $offersQuery->orderBy('created_at', 'DESC')->paginate(12);

        return view('admin.business.offers.show', compact('business', 'offers'));
    }

    function createOffer($item_id, $slug) {
        $business = Business::where('id', $item_id)->where('slug', $slug)->first();
        return view('admin.business.offers.create', compact('business'));
    }

    function addOffer(Request $request, $item_id, $slug) {
        
        $validator = Validator::make($request->all(),[
            'titre' => 'required|string',
            'slug' => 'required|string',
            'type' => 'required|string',
            'business_id' => 'required|exists:businesses,id',
            'price' => 'required|integer|min:500',
            'description' => 'nullable|string',
            'coverOffer' => 'mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $business = Business::where('id', $request->business_id)->where('slug', $request->slug)->first();

        if (!$business) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $user = $business->user()->first(); // business make by this one

        $data = [
            'titre' => $request->titre,
            'slug' => Str::slug($request->slug),
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'business_id' => $request->business_id,
            'user_id' => $user->id,
            'created_by' => Auth::user()->id,
        ];

        $offer = Offer::create($data);

        if ($request->hasFile('coverOffer')) {
            $offer->addMedia($request->file('coverOffer'))
                ->preservingOriginal()
                ->toMediaCollection('coverOffer');
        }

        session()->flash('success', 'Votre produit à été ajouté avec succès !');
        return redirect()->back();
    }

    function editOffer($item_id, $slug, $offer_id) {

        $business = Business::where('id', $item_id)->where('slug', $slug)->first();

        if (!$business) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $offer = $business->offers()->where('id', $offer_id)->first();

        if (!$offer) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        return view('admin.business.offers.edit', compact('business', 'offer'));
    }

    function updateOffer(Request $request) {
        $validator = Validator::make($request->all(),[
            'titre' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|integer|min:500',
            'description' => 'nullable|string',
            'coverOffer' => 'mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $offer = Offer::where('id', $request->offer_id)->first();

        if (!$offer) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $data = [
            'titre' => $request->titre,
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
        ];

        $offer->update($data);

        if ($request->hasFile('coverOffer')) {
            $offer->addMedia($request->file('coverOffer'))
                ->preservingOriginal()
                ->toMediaCollection('coverOffer');
        }

        session()->flash('success', 'Votre produit à été modifié avec succès !');
        return redirect()->back();
    }

    function validatedOffer($item_id, $slug, $offer_id) {
        $business = Business::where('id', $item_id)->where('slug', $slug)->first();

        if (!$business) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $offer = $business->offers()->where('id', $offer_id)->first();

        if (!$offer) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        if (!$offer->isValidated()) {
            $offer->validated = 1;
            $offer->validated_at = now();
            $offer->validated_by = Auth::user()->id;
            $offer->save();
            session()->flash('success', $offer->titre .' a été validé avec succès');
            return redirect()->back();
        }

        $offer->validated = 0;
        $offer->validated_at = now();
        $offer->validated_by = Auth::user()->id;
        $offer->save();
        session()->flash('success', $offer->titre .' a été retiré avec succès');
        return redirect()->back();
    }

    function deleteOffer($item_id, $slug, $offer_id) {
        $business = Business::where('id', $item_id)->where('slug', $slug)->first();

        if (!$business) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $offer = $business->offers()->where('id', $offer_id)->first();

        if (!$offer) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $offer->delete();

        session()->flash('success', 'Offer supprimée avec succès.');
        return redirect()->back();
    }
}
