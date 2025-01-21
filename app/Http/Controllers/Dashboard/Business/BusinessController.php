<?php

namespace App\Http\Controllers\Dashboard\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

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
}
