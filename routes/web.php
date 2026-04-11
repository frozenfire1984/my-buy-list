<?php
use App\Http\Controllers\BuyListController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

Route::get('/', function () {
    $top_items = Item::take(7)->get();
    return view('index', [
        'top_items' => $top_items,
        'meta' => [
            'title' => "Main page",
            'description' => "Lorem ipsum dolor sit amet",
            'keywords' => "Lorem, ipsum, dolor, sit, amet"
        ]
    ]);
});

// region Pages
Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    return view('contacts');
});
// endregion

// region Items
Route::get('/buy-list', [BuyListController::class, 'index']);

Route::get('/buy-list/{id}/details', [BuyListController::class, 'show']);

Route::get('/buy-list/create', [BuyListController::class, 'create']);

Route::post('/buy-list', [BuyListController::class, 'store']);

Route::get('/buy-list/{id}/edit', [BuyListController::class, 'edit']);

Route::put('/buy-list/{id}', [BuyListController::class, 'update']);

Route::delete('/buy-list/{id}', [BuyListController::class, 'destroy']);
// endregion

// region Categories
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/categories/{id}/details', [CategoryController::class, 'show']);

Route::get('/categories/create', [CategoryController::class, 'create']);

Route::post('/categories', [CategoryController::class, 'store']);

Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);

Route::put('/categories/{id}', [CategoryController::class, 'update']);

Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
// endregion




/*Route::get('/ping', [PingController::class, 'ping']);
Route::get('/ping/health', [PingController::class, 'health']);
Route::get('/ping/version', [PingController::class, 'version']);*/


