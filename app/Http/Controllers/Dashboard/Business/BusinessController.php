<?php

namespace App\Http\Controllers\Dashboard\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
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
            return redirect()->back();
        }

        $products = $business->products()->paginate(6);

        return view('admin.business.show', compact('business', 'products'));
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

    function saleProduct(Request $request) {

        $validator = Validator::make($request->all(),[
            'product_id' => 'required',
            'code' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'amount_received' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $product = Product::where('id', $request->product_id)->first();

        if ($product->price != $request->amount_received) {
            session()->flash('error', 'Vous devez entrer le bon montant');
            return redirect()->back();
        }
        
        Sale::create([
            'code' => $request->code,
            'amount_received' => $request->amount_received,
            'product_id' => $product->id,
            'quantity' => (int) $request->quantity,
            'price' => $product->price,
            'business_id' => $product->business->id,
            'manager_id' => $product->manager->id,
        ]);

        // Metre à jour la quantité de produit restant
        session()->flash('success', 'Vente effectué avec succès');
        return redirect()->back();
    }
}
