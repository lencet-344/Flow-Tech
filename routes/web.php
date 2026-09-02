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

Route::get('/explorar', function () {
    return view('usuario.explorar'); 
})->name('explorar.index');

Route::get('/', function () {
    $categorias = \App\Models\Category::take(8)->get(); 
    $negocios_destacados = \App\Models\Company::where('status', 'activo')->take(4)->get();
    $productos = \App\Models\Product::with('supplier')->latest()->take(6)->get();
    $mis_reservas = collect();

    // Solo cargamos reservas si hay sesión y el usuario es cliente/usuario
    if (auth()->check() && auth()->user()->role == 'usuario') { 
        $mis_reservas = \App\Models\Booking::latest()->take(3)->get();
    }

    return view('welcome', compact('categorias', 'negocios_destacados', 'productos', 'mis_reservas'));
})->name('welcome');


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



Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function() {
    
    Route::get('/admin/dashboard', function () { return view('admin.dashboard'); });
    Route::get('/admin/perfil', [\App\Http\Controllers\CompanyController::class, 'profile'])->name('admin.perfil');
    Route::get('/admin/inventario', function () { return view('admin.inventario'); });
    Route::get('/admin/ofertas', function () { return view('admin.ofertas'); });
    Route::get('/admin/comunidad', function () { return view('admin.comunidad'); });
    Route::get('/admin/estadisticas', function () { return view('admin.estadisticas'); });
    Route::get('/admin/comunidad-premium', function () { return view('admin.comunidad-premium'); });
    Route::get('/admin/premium/planes', function () { return view('admin.premium.planes'); })->name('premium.planes');
    Route::get('/admin/premium/checkout', function () { return view('admin.premium.checkout'); })->name('premium.checkout');
    Route::get('/admin/premium/success', function () { return view('admin.premium.success'); })->name('premium.success');
    
    
    Route::resource('products', ProductController::class);
    Route::resource('inventories', InventoryController::class);
    Route::get('/offers/success', [OfferController::class, 'success'])->name('offers.success');
    Route::resource('offers', OfferController::class);
    Route::resource('suppliers', SupplierController::class);
});



Route::middleware(['auth', 'verified', 'prevent-back-history'])->group(function() {

    // ── Flujo de reserva de producto agotado ──────────────────────────────────
        Route::get('/producto/agotado/reservar', function () {
    // Simulamos un producto de Eloquent para la presentación
    $producto = (object) [
        'id' => 999,
        'name' => 'Monitor Dell 27" 4K',
        'cost' => 4200,
        'image_url' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=300&q=80',
        'supplier' => (object) ['name' => 'TechSolutions GT']
    ];
    return view('usuario.reservar', compact('producto'));
});

    Route::get('/producto/{product}/reservar', function (\App\Models\Product $product) {
        $product->load(['supplier', 'category']);
        $inventario = \App\Models\Inventory::where('product_id', $product->id)->first();
        return view('usuario.reservar', ['producto' => $product, 'inventario' => $inventario]);
    })->name('usuario.producto.reservar');

    Route::post('/producto/{id}/reservar', function (\Illuminate\Http\Request $request, $id) {
    // Simulamos los datos de la reserva basados en el Figma para la presentación
    $reserva = (object) [
        'product' => (object) ['name' => 'Monitor Dell 27" 4K'],
        'supplier' => (object) ['name' => 'TechSolutions GT']
    ];
    return view('usuario.reserva-exito', compact('reserva'));
});

    Route::post('/producto/{product}/reservar', function (\Illuminate\Http\Request $request, \App\Models\Product $product) {
        $request->validate([
            'notes' => 'nullable|string|max:255',
        ]);
        $inventario = \App\Models\Inventory::where('product_id', $product->id)->first();
        $supplier_id = $inventario->supplier_id ?? 1;

        $booking = \App\Models\Booking::create([
            'date_booking'    => now()->toDateString(),
            'total_amount'    => $product->cost ?? 0,
            'deposit_amount'  => 0,
            'payment_method'  => 'En espera',
            'special_requests'=> ($request->notes ?? '') . ' | PRODUCTO: ' . ($product->name ?? ''),
            'supplier_id'     => $supplier_id,
        ]);

        return redirect()->route('usuario.reserva.exito', ['booking' => $booking->id, 'p' => $product->name]);
    })->name('usuario.producto.reservar.store');

    Route::get('/reserva/{booking}/exito', function (\Illuminate\Http\Request $request, \App\Models\Booking $booking) {
        $booking->load('supplier');
        
        // Simular la relación product para la vista de Figma
        $product_name = $request->query('p', 'Producto reservado');
        $booking->product = (object)['name' => $product_name];
        
        return view('usuario.reserva-exito', ['reserva' => $booking]);
    })->name('usuario.reserva.exito');
    // ─────────────────────────────────────────────────────────────────────────

    Route::resource('orders', OrderController::class);
    Route::resource('buy_verifications', Buy_verificationController::class);
        Route::get('/chat/proveedor', function () {
        return view('usuario.chat');
    })->name('usuario.chat.proveedor');

    Route::resource('bookings', BookingController::class);
    Route::resource('contact_requests', Contact_requestController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('trades', TradeController::class);
    Route::get('/premium/success', [PremiumController::class, 'success'])->name('premium.success');
});


Route::get('/admin/promocionar', function () { return view('admin.promocionar.configurar'); });
Route::get('/admin/promocionar/confirmar', function () { return view('admin.promocionar.confirmar'); });
Route::get('/admin/reservas', function () { return view('admin.reservas'); });
Route::get('/registro-tipo', function () { return view('auth.tipo-cuenta'); });
Route::get('/registro/cliente', function () { return view('auth.registro-cliente'); });
Route::get('/registro/proveedor', function () { return view('auth.registro-proveedor'); });
Route::get('/registro/servicios', function () { return view('auth.registro-servicios'); });
Route::get('/perfil-publico', function () { return view('public.profile'); });

require __DIR__.'/auth.php';
Route::get('/perfil-publico', function () { return view('public.profile'); });

Route::get('/chat-negocio', function () { return view('chat-negocio'); });
