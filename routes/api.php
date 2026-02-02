<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController;

Route::prefix('ping')->controller(PingController::class)->group(function () {
    Route::get('/', 'ping');
    Route::get('/health', 'health');
    Route::get('/version', 'version');
});

?>
