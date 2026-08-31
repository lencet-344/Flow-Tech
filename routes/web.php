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
use App\Http\Controllers\PremiumController;
use App\Http\Middleware\CheckSuperAdmin;

// La API de Mapa
Route::get('/mapa', function () {
    return view('mapa');
});

Route::get('/', function () {
    return view('welcome');
});


// RUTAS GENERALES (Para cualquier usuario logueado)
Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function() {
    Route::get('/dashboard', function () {
        $superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com', 'admin@sinki.com'];

        // Si es Isaac o Edmundo (VIP), les permitimos ver el panel de control crudo de Laravel
        if (auth()->check() && in_array(auth()->user()->email, $superAdmins)) {
            return view('dashboard');
        }

        // Si es cualquier otra persona (Cliente normal o Proveedor), los redirigimos al Welcome
        return redirect('/');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del Asistente IA
    Route::get('/chat', [GeminiController::class, 'index'])->name('chat.index');
    Route::post('/chat/ask', [GeminiController::class, 'ask'])->name('chat.ask');
});


// 1. RUTAS DEL SUPER ADMINISTRADOR (Protegidas por Middleware VIP)
Route::middleware(['auth', 'verified', 'prevent-back-history', CheckSuperAdmin::class])->group(function() {
    Route::get('/superadmin/dashboard', function () { return view('superadmin.dashboard'); });
    Route::get('/superadmin/usuarios', function () { 
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('superadmin.users', compact('users')); 
    })->name('superadmin.users');
    
    Route::patch('/superadmin/usuarios/{id}/toggle-status', function ($id) {
        $user = \App\Models\User::findOrFail($id);
        $user->status = $user->status === 'suspendido' ? 'activo' : 'suspendido';
        $user->save();
        return back()->with('success', 'Estado actualizado');
    })->name('admin.users.toggleStatus');
    Route::get('/superadmin/proveedores', function () { return view('superadmin.suppliers'); })->name('superadmin.suppliers');
    Route::get('/superadmin/negocios', function () { 
        return view('superadmin.businesses'); 
    })->name('superadmin.businesses');

    Route::patch('/superadmin/negocios/{id}/toggle-status', function ($id) {
        $company = \App\Models\Company::findOrFail($id);
        $company->status = $company->status === 'suspendido' ? 'activo' : 'suspendido';
        $company->save();
        return back()->with('success', 'Estado del negocio actualizado');
    })->name('admin.companies.toggleStatus');
    Route::get('/superadmin/publicaciones', function () { return view('superadmin.publications'); })->name('superadmin.publications');
    Route::get('/superadmin/reportes', function () { return view('superadmin.reports'); })->name('superadmin.reports');
    Route::get('/superadmin/soporte', function () { return view('superadmin.support'); })->name('superadmin.support');
    Route::get('/superadmin/consultas', function () { return view('superadmin.queries'); })->name('superadmin.queries');
    Route::get('/superadmin/moderacion', function () { return view('superadmin.moderation'); })->name('superadmin.moderation');
    Route::get('/superadmin/comunidad', function () { return view('superadmin.community'); })->name('superadmin.community');
    Route::resource('roles', RoleController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
});


// 2. RUTAS DEL PROVEEDOR / ADMIN (Recuperamos la seguridad original)
Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function() {
    // Vistas de Maquetación del Proveedor
    Route::get('/admin/dashboard', function () { return view('admin.dashboard'); });
    Route::get('/admin/perfil', [\App\Http\Controllers\CompanyController::class, 'profile'])->name('admin.perfil');
    Route::get('/admin/inventario', function () { return view('admin.inventario'); });
    Route::get('/admin/ofertas', function () { return view('admin.ofertas'); });
    Route::get('/admin/comunidad', function () { return view('admin.comunidad'); });
    Route::get('/admin/estadisticas', function () { return view('admin.estadisticas'); });
    Route::get('/admin/comunidad-premium', function () { return view('admin.comunidad-premium'); });
    
    // Controladores Reales
    Route::resource('products', ProductController::class);
    Route::resource('inventories', InventoryController::class);
    Route::get('/offers/success', [OfferController::class, 'success'])->name('offers.success');
    Route::resource('offers', OfferController::class);
    Route::resource('suppliers', SupplierController::class);
});


// 3. RUTAS DEL USUARIO / COMPRADOR 
Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function() {
    Route::resource('orders', OrderController::class);
    Route::resource('buy_verifications', Buy_verificationController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('contact_requests', Contact_requestController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('trades', TradeController::class);
    Route::get('/premium/success', [PremiumController::class, 'success'])->name('premium.success');
});

// Rutas públicas y de registro
Route::get('/admin/promocionar', function () { return view('admin.promocionar.configurar'); });
Route::get('/admin/promocionar/confirmar', function () { return view('admin.promocionar.confirmar'); });
Route::get('/admin/reservas', function () { return view('admin.reservas'); });
Route::get('/registro-tipo', function () { return view('auth.tipo-cuenta'); });
Route::get('/registro/cliente', function () { return view('auth.registro-cliente'); });
Route::get('/registro/proveedor', function () { return view('auth.registro-proveedor'); });
Route::get('/registro/servicios', function () { return view('auth.registro-servicios'); });
Route::get('/perfil-publico', function () { return view('public.profile'); });

require __DIR__.'/auth.php';