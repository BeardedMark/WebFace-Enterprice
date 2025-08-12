<?php

use Illuminate\Support\Facades\Route;
use App\Domains\OData\Http\Controllers\ODataController;
use App\Http\Controllers\{
    PageController,
    ContractorController,
    OfferController,
    CatalogController,
    OrderController,
    AuthController,
    ExtensionController,
    BasketController
};

use App\Http\Middleware\{
    CheckAuth,
    CheckGuest,
    checkAdmin
};

// Pages
Route::get('/', [PageController::class, 'main'])->name('pages.main');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/feed', [PageController::class, 'feed'])->name('pages.feed');
Route::get('/contacts', [PageController::class, 'contacts'])->name('pages.contacts');

Route::get('/enterprice', [PageController::class, 'enterprice'])->name('pages.enterprice');
Route::get('/extension', [PageController::class, 'extension'])->name('pages.extension');
Route::get('/enterprice-ping', [ODataController::class, 'ping'])->name('enterprice.ping');

// Auth
Route::middleware(CheckGuest::class)->group(function () {
Route::get('/login', [AuthController::class, 'enter'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registration']);
});

Route::middleware(CheckAuth::class)->group(function () {
    Route::get('/auth', [AuthController::class, 'main'])->name('auth.main');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('/contractors', ContractorController::class);
});

// Offers
Route::get('/catalogs/tree', [CatalogController::class, 'tree'])->name('catalogs.tree');
Route::resource('/catalogs', CatalogController::class);

Route::post('/offers/favorites/toggle/{id}', [OfferController::class, 'toggleFavorite'])->name('offers.toggleFavorite');
Route::post('/offers/compare/toggle/{id}', [OfferController::class, 'toggleCompare'])->name('offers.toggleCompare');
// Route::get('/offers/favorites', [OfferController::class, 'favorites'])->name('offers.favorites');
// Route::get('/offers/compare', [OfferController::class, 'compare'])->name('offers.compare');
Route::get('/offers/price', [OfferController::class, 'price'])->name('offers.price');
Route::resource('/offers', OfferController::class);



// Orders
Route::resource('/orders', OrderController::class);

Route::prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'index'])->name('basket.index');          // просмотр корзины
    Route::post('/add', [BasketController::class, 'add'])->name('basket.add');          // добавить товар
    Route::post('/update/{id}', [BasketController::class, 'update'])->name('basket.update'); // изменить количество
    Route::delete('/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove'); // удалить товар
    Route::delete('/clear', [BasketController::class, 'clear'])->name('basket.clear');  // очистить корзину
    Route::post('/basket/postpone/{id}', [BasketController::class, 'postpone'])->name('basket.postpone');
});

// OData
Route::get('/odata', [ODataController::class, 'dashboard'])->name('odata.dashboard');
Route::prefix('odata/{entity}')->controller(ODataController::class)->group(function () {
    Route::get('/', 'index')->name('odata.index');
    Route::get('/create', 'create')->name('odata.create');
    Route::post('/', 'store')->name('odata.store');
    Route::get('/{id}', 'show')->name('odata.show');
    Route::get('/{id}/edit', 'edit')->name('odata.edit');
    Route::put('/{id}', 'update')->name('odata.update');
    Route::delete('/{id}', 'destroy')->name('odata.destroy');
});
