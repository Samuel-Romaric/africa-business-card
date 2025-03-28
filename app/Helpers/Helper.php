<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {

    /**
     * Get active route
     * 
     * @param Illuminate\Routing\Route $route
     * @return string | css class
     */
    function isActiveRoute($routeName = '') {
        return Route::is($routeName) ? 'active' : '';
    }
}

if (!function_exists('flashy')) {

    /**
     * Get flash message on app
     * 
     * @param string | $type
     * @param string | $message
     * @return string | session message
     */
    function flashy($type = '', $message = '') {
        session()->flash($type, $message);
    }
}

if (!function_exists('getUserStatus')) {
    
    function getUserStatus(User $user) {
        if ($user->isBlocked()) {
            return 'Bloqué';
        }

        return 'Actif';
    }
}

if (!function_exists('getUserStatusClass')) {
    
    function getUserStatusClass(User $user) {
        if ($user->isBlocked()) {
            return 'status-danger';
        }

        return 'status-success';
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number = null) {
        if ($number >= 1 && $number < 10) {
            return '0' . $number; // Ajoute un 0 devant les chiffres de 0 à 9
        } elseif ($number < 1) {
            return '--';
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 1) . ' M'; // Convertit en Millions
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . ' K'; // Convertit en Milliers
        } else {
            return $number; // Affiche le nombre tel quel
        }
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice($price = null, $currency = 'F CFA') {
        
        return number_format($price, 0, ',', '.') . ' ' . $currency;
    }
}