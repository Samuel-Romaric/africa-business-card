<?php

// namespace App\Helpers;

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {

    function isActiveRoute($routeName = '') {
        return Route::is($routeName) ? 'active' : '';
    }
}