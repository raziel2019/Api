<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiSimulationController;


Route::get('/test', function () {
    return 'check';
});

Route::get('/simulate', [ApiSimulationController::class, 'simulate']);

