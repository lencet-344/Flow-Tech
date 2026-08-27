<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Buy_verificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Contact_requestController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TradeController;

use App\Http\Controllers\GeminiController;

//La APi de Mapa//

Route::get('/mapa', function () {
    return view('mapa');
});

Route::get('/', function () {
    return view('welcome');
});


// RUTAS GENERALES (Para cualquier usuario logueado)

Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// 1. RUTAS DEL ADMINISTRADOR (Control total)

Route::middleware(['auth', 'verified', 'prevent-back-history', 'role:administrador'])->group(function() {
    Route::resource('roles', RoleController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
});



// 2. RUTAS DEL PROVEEDOR (Gestión de oferta comercial)

Route::middleware(['auth', 'verified', 'prevent-back-history', 'role:proveedor'])->group(function() {
    Route::resource('products', ProductController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('suppliers', SupplierController::class);
});


// ==========================================
// 3. RUTAS DEL USUARIO / COMPRADOR 
// ==========================================
Route::middleware(['auth', 'verified', 'prevent-back-history', 'role:usuario'])->group(function() {
    Route::resource('orders', OrderController::class);
    Route::resource('buy_verifications', Buy_verificationController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('contact_requests', Contact_requestController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('trades', TradeController::class);
});

// Api de gemini
Route::get('/chat', [GeminiController::class, 'index']);
Route::post('/chat/ask', [GeminiController::class, 'ask'])->name('chat.ask');

require __DIR__.'/auth.php';