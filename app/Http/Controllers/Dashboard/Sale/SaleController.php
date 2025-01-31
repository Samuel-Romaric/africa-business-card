<?php

namespace App\Http\Controllers\Dashboard\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //
    function showAllSales() {
        $sales = Sale::all();

        return view('admin.sales.index', compact('sales'));
    }

    function showSale($sale_id) {
        $sale = Sale::where('id', $sale_id)->first();
        dd($sale);
    }
}
