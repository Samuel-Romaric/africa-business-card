<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Business\BusinessController;
use App\Http\Controllers\Dashboard\GeneralManagerController;
use App\Http\Controllers\Dashboard\Manager\ManagerController;
use App\Http\Controllers\Dashboard\Sale\SaleController;
use Illuminate\Support\Facades\Route;

// Guest route
Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login', 302);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Dashboard route if you are authentified
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard Routes
    Route::get('/dashboard', [GeneralManagerController::class, 'index'])->name('dashboard');

    // Managers Routes
    Route::prefix('/manager')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
    });

    // Business Routes
    Route::prefix('/business')->group(function () {
        Route::get('/all', [BusinessController::class, 'showBusinessList'])->name('business.index');
        Route::get('/show/{item_id}/{slug}/', [BusinessController::class, 'showBusiness'])->name('business.show');
        Route::get('/blocked/{item_id}/{slug}/', [BusinessController::class, 'blockedBusiness'])->name('business.blocked');
        Route::post('/sale/product/', [BusinessController::class, 'saleProduct'])->name('business.sale.product');
    });

    // Sales Routes
    Route::prefix('/sales')->group(function () {
        Route::get('/all', [SaleController::class, 'showAllSales'])->name('sales.index');
        Route::get('/{sale_id}/show', [SaleController::class, 'showSale'])->name('sales.show');
    });


    
});