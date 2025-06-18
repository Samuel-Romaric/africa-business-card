<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    //
    function index() {
        return view('admin.report.index');
    }

    function showReport(Request $request) {

        $query = Sale::query();

        // Relations utiles
        $query->with(['manager', 'business', 'offer']);

        // Recherche dynamique par manager OU entreprise
        if ($request->filled('filter_type') && $request->filled('search_value')) {
            $filterType = $request->filter_type;
            $value = $request->search_value;

            if ($filterType === 'manager') {
                // Recherche dans le user relié au manager
                // $query->whereHas('manager.user', function ($q) use ($value) {
                $query->whereHas('manager', function ($q) use ($value) {
                    $q->where('name', 'like', "%$value%")
                    ->orWhere('firstname', 'like', "%$value%");
                });
            }

            if ($filterType === 'business') {
                $query->whereHas('business', function ($q) use ($value) {
                    $q->where('nom_commercial', 'like', "%$value%");
                });
            }
        }

        // Filtres par dates
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $sales = $query->get();

        return view('admin.report.show', compact('sales'));
    }
}
