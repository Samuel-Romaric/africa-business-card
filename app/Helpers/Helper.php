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