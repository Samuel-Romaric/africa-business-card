<?php

namespace App\Http\Controllers\Dashboard\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    //
    function showAllSales() 
    {
        $sales = Sale::all();

        return view('admin.sales.index', compact('sales'));
    }

    function getSaleByAjax(Request $request) 
    {
        if ($request->ajax()) {
            try {
                $sale = Sale::where('id', $request->item_id)->first();

                $data = [
                    'id' => $sale->id,
                    'code' => $sale->code,
                    'nom_client' => $sale->nom_client,
                    'prenom_client' => $sale->prenom_client,
                    'telephone_client' => $sale->telephone_client,
                    'quantite' => $sale->quantite,
                    'prix' => $sale->prix,
                    'total' => $sale->total,
                    'montant_recu' => $sale->montant_recu,
                    'saler_id' => $sale->manager_id,
                    'marchandName' => $sale->getManagerFullName(),
                ];

                $result['action'] = true;
                $result['data'] = $data;

                return response()->json($result);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
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


    function updateSale(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'nom_client' => 'required|string',
            'prenom_client' => 'required|string',
            'telephone_client' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'sale_id' => 'required|exists:sales,id',
            'saler_id' => 'required|exists:users,id',
            'code' => 'required|string',
            'quantite' => 'numeric|min:1',
            'montant_recu' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $sale = Sale::where('id', $request->sale_id)->first();

        if (empty($sale)) {
            session()->flash('error', 'Veillez rééssayé plus tard');
            return redirect()->back();
        }

        if($sale->offer->price > $request->montant_recu) {
            session()->flash('warning', 'Vous devez entrer le bon montant');
            return redirect()->back();
        }

        $user = User::where('is_blocked', 0)->where('code', $request->code)->where('id', $request->saler_id)->first();

        if ($user->isManager()) {

            $sale->update([
                'code' => $request->code,
                'montant_recu' => (int) $request->montant_recu,
                'nom_client' => $request->nom_client,
                'prenom_client' => $request->prenom_client,
                'telephone_client' => $request->telephone_client,
                'quantite' => (int) $request->quantite,
                'prix' => (int) $sale->offer->price,
                'total' => (int) $sale->offer->type === 'service' ? $sale->offer->price : $request->total,
                'montant_recu' => $request->montant_recu,
                'manager_id' => $request->saler_id,
            ]);

            session()->flash('success', 'Information mise à jour avec succès');
            return redirect()->back();
        }

        session()->flash('error', 'Vous devenz saisir le code d\'un manager');
        return redirect()->back();
    }


    function deleteSale($item_id) {
        if (!is_null($item_id)) {
            $sale = Sale::where('id', $item_id)->first();

            if (!is_null($sale)) {
                $sale->delete();

                session()->flash('success', 'Vente supprimé avec succès');
                return redirect()->back();
            }
        }
    }
}
