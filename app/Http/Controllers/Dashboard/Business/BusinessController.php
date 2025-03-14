<?php

namespace App\Http\Controllers\Dashboard\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Offer;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    //
    function showBusinessList() {
        
        $businesses = Business::orderBy('created_at', 'DESC')->get();

        return view('admin.business.index', compact('businesses'));
    }

    function showBusiness($item_id, $slug) {

        $business = Business::where('id', $item_id)->where('slug', $slug)->first();

        if (is_null($business)) {
            session()->flash('error', 'Une erreur s\'est produite');
            return redirect()->back();
        }

        $offers = $business->offers()->paginate(12);

        return view('admin.business.show', compact('business', 'offers'));
    }

    function blockedBusiness($item_id, $slug) {

        $business = Business::where('id', $item_id)->where('slug', $slug)->first();

        if (is_null($business)) {
            return redirect()->back();
        }

        if ($business->isBlocked()) {
            $business->update([
                'is_blocked' => 0
            ]);
        } else {
            $business->update([
                'is_blocked' => 1
            ]);
        }
        
        return redirect()->back();
    }

    function saleOffer(Request $request) {

        $validator = Validator::make($request->all(),[
            'nom_client' => 'required|string',
            'offer_id' => 'required|exists:offers,id',
            'saler_id' => 'required|exists:users,id',
            'code' => 'required|string',
            'quantite' => 'required|numeric|min:1',
            'montant_recu' => 'required|numeric|min:100',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $offer = Offer::where('id', $request->offer_id)->first();

        if ($offer->price != $request->montant_recu) {
            session()->flash('warning', 'Vous devez entrer le bon montant');
            return redirect()->back();
        }

        $user = User::where('code', $request->code)->where('id', $request->saler_id)->first();
        
        if ($user->isManager()) {
            Sale::create([
                'code' => $request->code,
                'montant_recu' => (int) $request->montant_recu,
                'quantite' => (int) $request->quantite,
                'nom_client' => $request->nom_client,
                'prix' => (int) $offer->price,
                'offer_id' => $offer->id,
                'business_id' => $offer->business->id,
                'manager_id' => $request->saler_id,
                'admin_id' => Auth::user()->id,
            ]);

            session()->flash('success', 'Vente effectué avec succès');
            return redirect()->back();
        }

        session()->flash('danger', "Vous devez saisir le code d'un manager");
        return redirect()->back();
    }

    function getSalerByAjax(Request $request) {
        
        if ($request->ajax()) {

            try {
                if (($request->codeSaler)) {
                    $user = User::where('is_blocked', 0)->where('code', $request->codeSaler)->first();

                    if (!is_null($user)) {
                        $data = [
                            'fullname' => $user->firstname.' '.$user->name,
                            'saler_id' => $user->id,
                        ];
                        
                        $result['message'] = 'Code validé';
                        $result['action'] = true;
                        $result['data'] = $data;

                        return response()->json($result);
                    }
                    
                    $result['action'] = false;
                    $result['message'] = 'Code manager invalide';
                    return response()->json($result);
                }

            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
