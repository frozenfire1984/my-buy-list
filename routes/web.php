<?php
use App\Http\Controllers\BuyListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', [
        'meta' => [
            'title' => "Main page",
            'description' => "Lorem ipsum dolor sit amet",
            'keywords' => "Lorem, ipsum, dolor, sit, amet"
        ]
    ]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/buy-list', [BuyListController::class, 'index']);

Route::get('/buy-list-details/{id}', [BuyListController::class, 'show']);

Route::get('/buy-list-create', [BuyListController::class, 'create']);



Route::post('/buy-list-create', [BuyListController::class, 'store']);

Route::get('/buy-list-edit/{id}', [BuyListController::class, 'edit']);

Route::put('/buy-list/{id}', [BuyListController::class, 'update']);

Route::delete('/buy-list/{id}', [BuyListController::class, 'destroy']);




/*Route::get('/ping', [PingController::class, 'ping']);
Route::get('/ping/health', [PingController::class, 'health']);
Route::get('/ping/version', [PingController::class, 'version']);*/


