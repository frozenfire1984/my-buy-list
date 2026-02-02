<?php

use App\Http\Controllers\PingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/ping', [PingController::class, 'ping']);
Route::get('/ping/health', [PingController::class, 'health']);
Route::get('/ping/version', [PingController::class, 'version']);*/


