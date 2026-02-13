<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index']);
Route::post('/save', [LandingController::class, 'store']);
