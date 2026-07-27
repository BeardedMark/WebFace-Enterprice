<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PageController,
    AuthController,
    ImageController
};

use App\Http\Controllers\Etp\{
    ContractorController,
    OfferController,
    CatalogController,
    OrderController,
    ManufacturerController,
    BrandController,
    PostController
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
Route::get('/sitemap', [PageController::class, 'sitemap'])->name('pages.sitemap');
Route::get('/search', [PageController::class, 'search'])->name('pages.search');

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

    Route::get('/contractors/orders', [ContractorController::class, 'orders'])->name('contractors.orders');
    Route::get('/contractors/offers', [ContractorController::class, 'offers'])->name('contractors.offers');
    Route::get('/contractors/prices', [ContractorController::class, 'prices'])->name('contractors.prices');
    Route::resource('/contractors', ContractorController::class);
});

// Images proxy
Route::get('/images/{type}/{guid}', [ImageController::class, 'proxy'])->name('images.proxy');

// Catalogs
Route::get('/catalogs/tree', [CatalogController::class, 'tree'])->name('catalogs.tree');
Route::resource('/catalogs', CatalogController::class);

// Offers
// Route::get('/offers/favorites', [OfferController::class, 'favorites'])->name('offers.favorites');
Route::get('/offers/compare', [OfferController::class, 'compare'])->name('offers.compare');
Route::get('/offers/{guid}/card', [OfferController::class, 'card'])->name('offers.card');
Route::post('/offers/items', [OfferController::class, 'items'])->name('offers.items');
Route::get('/offers/price', [OfferController::class, 'price'])->name('offers.price');
Route::get('/offers/offerbyorder', [OfferController::class, 'offerbyorder']);
Route::resource('/offers', OfferController::class);

// Orders
Route::get('/basket', [OrderController::class, 'basket'])->name('orders.basket');

// Resource
Route::resource('/orders', OrderController::class);
Route::resource('/manufacturers', ManufacturerController::class);
Route::resource('/brands', BrandController::class);
Route::resource('/posts', PostController::class);

