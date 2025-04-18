<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Business\BusinessController;
use App\Http\Controllers\Dashboard\Business\Offer\OfferControler;
use App\Http\Controllers\Dashboard\Commerciaux\CommerciauxController;
use App\Http\Controllers\Dashboard\GeneralManagerController;
use App\Http\Controllers\Dashboard\Manager\ManagerController;
use App\Http\Controllers\Dashboard\Profile\ProfilController;
use App\Http\Controllers\Dashboard\Report\ReportController;
use App\Http\Controllers\Dashboard\Sale\SaleController;
use App\Http\Controllers\Dashboard\Subscription\SubscriptionController;
use App\Http\Controllers\Dashboard\Users\UserController;
use Illuminate\Support\Facades\Route;

// Guest route
Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login', 302);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Dashboard route when user is authentified
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard Routes
    Route::get('/dashboard', [GeneralManagerController::class, 'index'])->name('dashboard');

    // Managers Routes
    Route::prefix('/managers')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
        Route::get('/{user_id}/show', [ManagerController::class, 'showManager'])->name('manager.show');
        Route::get('/{user_id}/blocked', [ManagerController::class, 'blockedManager'])->name('manager.blocked');
    });

    // Caommerciaux Routes
    Route::prefix('/commerciaux')->group(function () {
        Route::get('/', [CommerciauxController::class,'showAllCommerciaux'])->name('commerciaux.index');
        Route::get('/{user_id}/blocked-commercial', [CommerciauxController::class, 'blockedCommercial'])->name('commercial.blocked');
        Route::get('/{user_id}/show', [CommerciauxController::class, 'showCommercial'])->name('commercial.show');
    });

    // Business Routes
    Route::prefix('/business')->group(function () {
        Route::get('/', [BusinessController::class, 'showBusinessList'])->name('business.index');

        // Offers (services or products) Routes 
        Route::prefix('/{item_id}/offers')->group(function () {
            Route::get('/{slug}', [OfferControler::class, 'showOffers'])->name('business.offers.show');
            Route::get('/{slug}/create', [OfferControler::class, 'createOffer'])->name('business.offer.create');
            Route::post('/{slug}/add', [OfferControler::class, 'addOffer'])->name('business.offer.add');
            Route::get('/{slug}/{offer_id}/edit', [OfferControler::class, 'editOffer'])->name('business.offer.edit');
            Route::post('/{slug}/update', [OfferControler::class, 'updateOffer'])->name('business.offer.update');
            Route::get('/{slug}/{offer_id}/validated', [OfferControler::class, 'validatedOffer'])->name('business.offer.validated');
            Route::get('/{slug}/{offer_id}/delete', [OfferControler::class, 'deleteOffer'])->name('business.offer.delete');
        });

        // Route::get('/{item_id}/offers/{slug}/', [BusinessController::class, 'showBusiness'])->name('business.offers.show');
        Route::get('/blocked/{item_id}/{slug}/', [BusinessController::class, 'blockedBusiness'])->name('business.blocked');
        Route::post('/sale/offer/', [BusinessController::class, 'saleOffer'])->name('business.sale.offer');
        Route::get('/get-saler-by-ajax', [BusinessController::class, 'getSalerByAjax'])->name('business.get-saler-by-ajax');
    });

    // Sales Routes
    Route::prefix('/sales')->group(function () {
        Route::get('/', [SaleController::class, 'showAllSales'])->name('sales.index');
        Route::get('/get-sale-by-ajax', [SaleController::class, 'getSaleByAjax'])->name('sale.get-by-ajax');
        Route::get('/get-user-saler-by-ajax', [SaleController::class, 'getSalerByAjax'])->name('sale.get-user-saler-by-ajax');
        Route::post('/update', [SaleController::class, 'updateSale'])->name('sales.update');
        Route::get('/delete/{item_id}/', [SaleController::class, 'deleteSale'])->name('sale.delete');
    });

    // Subscription Routes
    Route::prefix('/subscription')->group(function () {
        Route::get('/', [SubscriptionController::class, 'index'])->name('subscription.index');
    });

    // Report Routes
    Route::prefix('/report')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('report.index');
        Route::get('/show', [ReportController::class, 'showReport'])->name('report.show');
    });

    // Manage Users Routes
    Route::middleware('isGlobalAdmin')->prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{user_id}/blocked', [UserController::class, 'blockedUser'])->name('user.blocked');
        Route::get('/{user_id}/{slug}/show', [UserController::class, 'showUser'])->name('user.show');
        Route::get('/{user_id}/{slug}/edit', [UserController::class, 'editUser'])->name('user.edit');
        Route::post('/personal-info/user/update', [UserController::class, 'updatePersonalUserInfo'])->name('user.update-personal-info');
        
        Route::post('/reset/user/password', [UserController::class, 'resetUserPassword'])->name('user.reset-password');
        Route::post('/add/user/permission', [UserController::class, 'addPermissionUser'])->name('user.add-permission');

        Route::get('/user/add/form', [UserController::class, 'showAddFormUser'])->name('user.add-form');
        Route::post('/user/add/', [UserController::class, 'addUser'])->name('user.add-user');
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfilController::class, 'showProfile'])->name('profile.show');
        Route::get('/settings/{slug}', [ProfilController::class, 'settingsProfile'])->name('profile.settings');
        Route::post('/settings/update/info', [ProfilController::class, 'updatePersonalInfo'])->name('profile.update-personal-info');
        Route::post('/settings/reset/password', [ProfilController::class, 'resetPassword'])->name('profile.reset-password');
    });
    
});