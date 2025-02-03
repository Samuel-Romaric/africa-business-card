<?php

namespace App\Http\Controllers\Dashboard\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
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
                    'quantity' => $sale->quantity,
                    'amount_received' => $sale->amount_received,
                ];

                $result['action'] = true;
                $result['data'] = $data;

                return response()->json($result);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    function updateSale(Request $request) {

        $validator = Validator::make($request->all(),[
            'sale_id' => 'required',
            'code' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'amount_received' => 'required|numeric|min:1',
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

        $sale->update([
            'code' => $request->code,
            'quantity' => $request->quantity,
            'amount_received' => $request->amount_received,
        ]);

        session()->flash('success', 'Information mise à jour avec succès');
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
