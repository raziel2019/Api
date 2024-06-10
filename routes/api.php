<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiSimulationController;


Route::get('/test', function () {
    return 'check';
});

Route::post('/simulate', [ApiSimulationController::class, 'simulate']);
Route::get('/obtener-datos', [ApiSimulationController::class, 'obtenerDatos']);


