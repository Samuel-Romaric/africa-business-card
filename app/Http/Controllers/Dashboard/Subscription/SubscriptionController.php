<?php

namespace App\Http\Controllers\Dashboard\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Souscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    function index() {
        $subscription = Souscription::all();
        // dd($subscription);
        return view('admin.subscription.index', compact('subscription'));
    }
}
