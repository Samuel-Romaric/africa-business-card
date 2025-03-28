<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Offer;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralManagerController extends Controller
{
    //
    function index() {

        // Draw Graph
        $monthlySales = Sale::selectRaw('MONTH(created_at) as month, SUM(montant_recu * quantite) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $dailySales = Sale::selectRaw('DAY(created_at) as day, SUM(montant_recu * quantite) as total')
            ->whereMonth('created_at', date('m')) // Filtrer sur le mois actuel
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // dd($monthlySales);
        // $data = [
        //     'labels' => $monthlySales->pluck('month')->map(fn($m) => date("M", mktime(0, 0, 0, $m, 1))),
        //     'data' => $monthlySales->pluck('total'),
        // ];

        $data = [
            'monthlyLabels' => $monthlySales->pluck('month')->map(fn($m) => date("M", mktime(0, 0, 0, $m, 1))),
            'monthlyData' => $monthlySales->pluck('total'),
        
            'dailyLabels' => $dailySales->pluck('day'),
            'dailyData' => $dailySales->pluck('total'),
        ];

        // Count item
        $totalBusiness = Business::count();
        $totalProduct = Offer::where('type', 'produit')->count();
        $totalService = Offer::where('type', 'service')->count();

        // Acount total
        $user = User::get();
        
        $managerActif = $user->where('role', 'manager')->where('is_blocked', 0);
        $managerBlocked = $user->where('role', 'manager')->where('is_blocked', 1);
        
        $commercialActif = $user->where('role', 'commercial')->where('is_blocked', 0);
        $commercialBlocked = $user->where('role', 'commercial')->where('is_blocked', 1);
        
        $businessActif = $user->where('role', 'business')->where('is_blocked', 0);
        $businessBlocked = $user->where('role', 'business')->where('is_blocked', 1);

        $adminBlocked = $user->where('role', 'admin')->where('is_blocked', 1);
        $adminActif = $user->where('role', 'admin')->where('is_blocked', 0);
        
        // $totalUser = $user->count();

        $totalUserData = [
            'managerActif' => $managerActif->count(),
            'managerBlocked' => $managerBlocked->count(),
            'commercialActif' => $commercialActif->count(),
            'commercialBlocked' => $commercialBlocked->count(),
            'businessActif' => $businessActif->count(),
            'businessBlocked' => $businessBlocked->count(),
            'adminBlocked' => $adminBlocked->count(),
            'adminActif' => $adminActif->count(),
            'totalUser' => $user->count(),
        ];

        return view('admin.dashboard', compact('data', 'totalBusiness', 'totalProduct', 'totalService', 'totalUserData'));
    }
}
