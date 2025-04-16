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

        // dd($request->all());

        // $validator = Validator::make($request->all(), [
        //     '' => '',
        // ]);

        $query = Sale::query();

        // dd($query->get());

        // Vérifier si AU MOINS un champ est rempli
        if (!$request->filled(['manager', 'business', 'start_date', 'end_date'])) {
            // return view('admin.report.show', ['sales' => []]); // Renvoie une liste vide
            return view('admin.report.show', ['sales' => $query->get()]); // Renvoie une liste vide
        }

        // 🔹 Filtrer par manager (via users)
        if ($request->filled('manager')) {
            $query->whereHas('manager', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->manager . '%');
            });
        }

        // 🔹 Filtrer par entreprise (business)
        if ($request->filled('business')) {
            $query->whereHas('business', function ($q) use ($request) {
                $q->where('nom_commercial', 'like', '%' . $request->business . '%');
            });
        }

        // 🔹 Filtrer par date de début et de fin
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // 🔹 Récupérer les ventes avec les relations
        $sales = $query->with(['manager', 'business', 'offer'])->get();

        return view('admin.report.show', compact('sales'));
    }
}
