<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PageController,
    ContractorController,
    OfferController,
    CatalogController,
    OrderController,
    AuthController,
    BasketController
};

use App\Http\Middleware\{
    CheckAuth,
    CheckGuest
};

// Pages
Route::get('/', [PageController::class, 'main'])->name('pages.main');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('pages.contacts');
Route::post('/message', [PageController::class, 'message'])->name('pages.message');
Route::get('/privacy', [PageController::class, 'privacy'])->name('pages.privacy');

// Auth
Route::middleware(CheckGuest::class)->group(function () {
    Route::get('/login', [AuthController::class, 'enter'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'registration']);
    Route::get('/restore', [AuthController::class, 'restore'])->name('auth.restore');
    Route::post('/restore', [AuthController::class, 'restored']);
});

Route::middleware(CheckAuth::class)->group(function () {
    Route::get('/auth', [AuthController::class, 'main'])->name('auth.main');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('/contractors', ContractorController::class);
});

// Offers
Route::get('/catalogs/tree', [CatalogController::class, 'tree'])->name('catalogs.tree');
Route::resource('/catalogs', CatalogController::class);

Route::get('/offers/favorites', [OfferController::class, 'favorites'])->name('offers.favorites');
Route::get('/offers/compare', [OfferController::class, 'compare'])->name('offers.compare');
Route::post('/offers/items', [OfferController::class, 'items'])->name('offers.items');
Route::get('/offers/price', [OfferController::class, 'price'])->name('offers.price');
Route::resource('/offers', OfferController::class);



// Orders
Route::resource('/orders', OrderController::class);
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/sync', [BasketController::class, 'sync'])->name('basket.sync');
Route::post('/basket/items', [BasketController::class, 'items'])->name('basket.items');
Route::get('/basket/offerbyorder', [BasketController::class, 'offerbyorder']);

// Route::prefix('basket')->group(function () {
//     Route::get('/', [BasketController::class, 'index'])->name('basket.index');          // просмотр корзины
//     Route::post('/add', [BasketController::class, 'add'])->name('basket.add');          // добавить товар
//     Route::post('/update/{id}', [BasketController::class, 'update'])->name('basket.update'); // изменить количество
//     Route::delete('/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove'); // удалить товар
//     Route::delete('/clear', [BasketController::class, 'clear'])->name('basket.clear');  // очистить корзину
//     Route::post('/basket/postpone/{id}', [BasketController::class, 'postpone'])->name('basket.postpone');
// });
