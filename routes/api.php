<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\SuscribeController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes publiques (sans authentification)
Route::post('/register', [ApiAuthController::class, 'register'])->name('api.register');
Route::get('/login', [ApiAuthController::class, 'login'])->name('api.login');

// Routes protégées (nécessitent une authentification)
// Ces routes nécessitent que l'utilisateur soit authentifié via Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', [ApiAuthController::class, 'getUser'])->name('api.user');

    // Souscription à au offres de produits
    Route::get('/subscribe', [SuscribeController::class, 'subscribe'])->name('api.subscribe');
    
    // Récupération des offres de produits
    Route::get('/offers', [OfferController::class, 'getAllOffers'])->name('api.offers');
    Route::get('/offer/{id}', [OfferController::class, 'getOfferById'])->name('api.offer.by.id');

    // Deconnexion de l'utilisateur dans l'application
    Route::get('/logout', [ApiAuthController::class, 'logout'])->name('api.logout');
});

