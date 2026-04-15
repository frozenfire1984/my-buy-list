<?php
use App\Http\Controllers\BuyListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

/*Route::get('/', function () {
    return view('index');
});*/

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
Route::prefix('buy-list')->group(function() {
    Route::get('/', [BuyListController::class, 'index']);
    Route::get('/{id}/details', [BuyListController::class, 'show']);
});

Route::prefix('buy-list')->middleware('auth')->group(function() {
    Route::get('/create', [BuyListController::class, 'create']);
    Route::post('/', [BuyListController::class, 'store']);
    Route::get('/{id}/edit', [BuyListController::class, 'edit']);
    Route::put('/{id}', [BuyListController::class, 'update']);
    Route::delete('/{id}', [BuyListController::class, 'destroy']);
});
// endregion

// region Categories
Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}/details', [CategoryController::class, 'show']);
});

Route::prefix('categories')->middleware('auth')->group(function() {
    Route::get('/create', [CategoryController::class, 'create']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});
// endregion

/*Route::get('/ping', [PingController::class, 'ping']);
Route::get('/ping/health', [PingController::class, 'health']);
Route::get('/ping/version', [PingController::class, 'version']);*/

// region Auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
// endregion
