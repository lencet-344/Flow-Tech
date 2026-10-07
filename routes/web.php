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
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\RoleSelectionController;

// ── RUTA DE ONBOARDING (Asignación de Rol) ──────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::post('/seleccionar-rol', [RoleSelectionController::class, 'assignRole'])->name('role.assign');
});

// ── RUTAS PÚBLICAS ──────────────────────────────────────────────────────────
Route::get('/', function () {
    $categorias = \App\Models\Category::withCount('companies')->take(8)->get(); 
    $negocios_destacados = \App\Models\Company::where('status', 'activo')->take(4)->get();
    $productos = \App\Models\Product::with('supplier')->latest()->take(6)->get();
    $mis_reservas = collect();

    if (auth()->check() && in_array(auth()->user()->role, ['usuario', 'cliente'])) { 
        $mis_reservas = \App\Models\Booking::latest()->take(3)->get();
    }

    return view('welcome', compact('categorias', 'negocios_destacados', 'productos', 'mis_reservas'));
})->name('welcome');

Route::get('/mapa', function () { return view('mapa'); });
Route::get('/explorar', [CategoryController::class, 'explorar'])->name('explorar.index');
Route::get('/redes', function () { return view('public.redes'); })->name('redes.index');
Route::get('/registro-tipo', function () { return view('auth.tipo-cuenta'); });
Route::get('/registro/cliente', function () { return view('auth.registro-cliente'); });
Route::get('/registro/proveedor', function () { return view('auth.registro-proveedor'); });
Route::get('/registro/servicios', function () { return view('auth.registro-servicios'); });
Route::get('/chat-negocio', function () {
    $id = request('id');
    $nombre = request('negocio') ?? request('empresa');

    $company = \App\Models\Company::with('category')
        ->when($id, fn($q) => $q->where('id', $id))
        ->when($nombre && !$id, fn($q) => $q->where('name', $nombre)->orWhere('name', 'like', '%' . $nombre . '%'))
        ->first();

    if (!$company && $nombre) {
        $desc = "Negocio registrado en la plataforma SINGKI.";
        $cat = 'Comercio / Servicios';
        $email = 'contacto@' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nombre)) . '.com';
        $dir = 'No especificada';
        $tel = 'No disponible';

        if ($nombre == 'Moda Express') {
            $cat = 'Moda';
            $desc = "Ropa y accesorios al por mayor. Colecciones para dama y caballero.";
            $dir = "Av. Central, Estelí";
            $tel = "8888-1020";
            $email = "contacto@modaexpress.com";
        } elseif ($nombre == 'TechSolutions GT') {
            $cat = 'Tecnología';
            $desc = "Soluciones tecnológicas para empresas. Hardware y soporte.";
            $dir = "Zona Centro, Estelí";
            $tel = "8888-3040";
            $email = "carlos@techsolutions.com";
        } elseif ($nombre == 'Distribuidora Alimentos Norte') {
            $cat = 'Alimentos';
            $desc = "Distribución mayorista de alimentos secos y enlatados.";
            $dir = "Carretera Norte, Estelí";
            $tel = "8888-5060";
            $email = "ventas@alimentosnorte.com";
        }

        $company = (object)[
            'id' => rand(1000, 9000),
            'name' => $nombre,
            'description' => $desc,
            'category' => (object)['name' => $cat],
            'address' => $dir,
            'telephone' => $tel,
            'email' => $email,
            'horario' => 'Lunes a Viernes, 8:00 AM - 5:00 PM',
            'created_at' => now(),
            'logo' => null,
            'website' => null,
            'products' => collect([]),
            'inventories' => collect([]),
            'offers' => collect([]),
        ];
    } elseif (!$company) {
        $company = (object)[
            'id' => rand(1000, 9000),
            'name' => 'Negocio Desconocido',
            'description' => 'Negocio registrado en la plataforma SINGKI.',
            'category' => (object)['name' => 'Comercio / Servicios'],
            'address' => 'No especificada',
            'telephone' => 'No disponible',
            'email' => 'contacto@singki.com',
            'horario' => 'Lunes a Viernes, 8:00 AM - 5:00 PM',
            'created_at' => now(),
            'logo' => null,
            'website' => null,
            'products' => collect([]),
            'inventories' => collect([]),
            'offers' => collect([]),
        ];
    }

    return view('usuario.chat-negocio', compact('company'));
});


// Ruta hacia el perfil público (manejada por el controlador para pasar la variable $negocio)
Route::get('/perfil-publico', [App\Http\Controllers\CompanyController::class, 'publicProfile'])->name('public.profile')->middleware('auth');

// Rutas públicas del Asistente IA "Ki" (movidas aquí para acceso libre de invitados)
Route::get('/chat', [GeminiController::class, 'index'])->name('chat.index');
Route::post('/chat/ask', [GeminiController::class, 'ask'])->name('chat.ask');

// Rutas de contacto (Públicas)
Route::resource('contact_requests', Contact_requestController::class)->only(['create', 'store']);
Route::get('/centro-ayuda', fn() => view('public.help'))->name('public.help');
Route::get('/terminos', fn() => view('public.terms'))->name('public.terms');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// ── RUTAS DE 2FA (Requieren login, pero NO 2FA verificado) ──────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/verificacion-2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
    Route::post('/verificacion-2fa', [TwoFactorController::class, 'verify'])->name('2fa.verify');

// ── RUTAS DE CATÁLOGO (Accesibles para usuarios autenticados) ──────────────
    Route::post('/favoritos/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

});


// ── RUTAS GENERALES PROTEGIDAS POR 2FA ──────────────────────────────────────
Route::middleware(['auth', '2fa_verified', 'verified', 'prevent-back-history'])->group(function() {
    Route::get('/dashboard', function () {
        $superAdmins = ['isaacmeneses254@gmail.com', 'edmundo@ejemplo.com', 'admin@sinki.com'];

        if (auth()->check() && in_array(auth()->user()->email, $superAdmins)) {
            return view('dashboard');
        }

        return redirect('/');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ── 1. RUTAS DEL SUPER ADMINISTRADOR (Protegidas por 2FA + CheckSuperAdmin) ─
Route::middleware(['auth', '2fa_verified', 'verified', 'prevent-back-history', CheckSuperAdmin::class])->group(function() {
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
        $companies = \App\Models\Company::with('category')->orderByRaw("name = 'wawastech' DESC")->orderBy('id', 'desc')->get();
        return view('superadmin.businesses', compact('companies')); 
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


// ── 2. RUTAS DE ADMINISTRACIÓN B2B (Protegidas por 2FA) ─────────────────────
Route::middleware(['auth', '2fa_verified', 'verified', 'prevent-back-history', 'role:proveedor'])->group(function() {
    Route::get('/admin/dashboard', function () {
        $company = \App\Models\Company::where('email', auth()->user()->email)->first() 
                ?? auth()->user()->company 
                ?? \App\Models\Company::where('name', 'wawastech')->first() 
                ?? \App\Models\Company::latest('id')->first();
        $inventories = \App\Models\Inventory::with("product", "supplier")->get();
        $bookings = \App\Models\Booking::with("supplier")->latest()->get();
        return view('admin.dashboard', compact('company', 'inventories', 'bookings'));
    });
    Route::get('/admin/perfil', [\App\Http\Controllers\CompanyController::class, 'profile'])->name('admin.perfil');
    Route::put('/admin/perfil/actualizar/{company}', [\App\Http\Controllers\CompanyController::class, 'update'])->name('admin.perfil.update');
    
    Route::get('/admin/inventario', function () { return view('admin.inventario'); });
    Route::get('/admin/ofertas', function () { return view('admin.ofertas'); });
    Route::get('/admin/comunidad', function () { 
        $questions = \App\Models\CommunityQuestion::latest()->get();
        return view('admin.comunidad', compact('questions')); 
    });
    Route::post('/admin/comunidad/preguntar', function (\Illuminate\Http\Request $request) {
        $request->validate(['category' => 'required|string', 'question' => 'required|string']);
        \App\Models\CommunityQuestion::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'question' => $request->question,
            'status' => 'pendiente'
        ]);
        return back()->with('success', 'Pregunta enviada');
    });
    Route::get('/admin/estadisticas', function () { 
        $company = auth()->user()->company;
        $company_id = $company ? $company->id : 0;
        $reservas = \App\Models\Booking::where('supplier_id', $company_id)->count();
        $guardados = \App\Models\Favorite::whereIn('product_id', $company ? $company->products->pluck('id') : [])->count();
        $contactos = \App\Models\Contact_request::where('company_id', $company_id)->count();
        $visitas = $reservas * 14 + 25;
        return view('admin.estadisticas', compact('visitas', 'guardados', 'contactos', 'reservas')); 
    });
    Route::get('/admin/comunidad-premium', function () { return view('admin.comunidad-premium'); });
    Route::get('/admin/premium/planes', function () { return view('admin.premium.planes'); })->name('premium.planes');
    Route::get('/admin/premium/checkout', function () { return view('admin.premium.checkout'); })->name('premium.checkout');
    Route::get('/admin/premium/success', function () {
        if (auth()->check()) {
            auth()->user()->update(['is_premium' => true]);
        }
        return view('admin.premium.success');
    })->name('premium.success');
    Route::get('/admin/promocionar', function () { return view('admin.promocionar.configurar'); });
    Route::get('/admin/promocionar/confirmar', function () { return view('admin.promocionar.confirmar'); });
    Route::get('/admin/reservas', function () { return view('admin.reservas'); });
    
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::resource('inventories', InventoryController::class);
    Route::get('/offers/success', [OfferController::class, 'success'])->name('offers.success');
    Route::resource('offers', OfferController::class);
    Route::resource('suppliers', SupplierController::class);
});


// ── 3. FLUJO DE RESERVAS Y OPERACIONES LOGÍSTICAS (Protegidas por 2FA) ───────
Route::middleware(['auth', '2fa_verified', 'verified', 'prevent-back-history', 'role:cliente'])->group(function() {
    Route::get('/producto/agotado/reservar', function () {
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
        $inventario = \App\Models\Inventory::with('supplier')->where('product_id', $product->id)->first();
        
        if (!$inventario?->supplier && !$product->supplier) {
            $suppliers = \App\Models\Supplier::all();
            if ($suppliers->count() > 0) {
                $product->setRelation('supplier', $suppliers->get($product->id % $suppliers->count()));
            } else {
                $companies = \App\Models\Company::where('name', '!=', 'wawastech')->get();
                if ($companies->count() > 0) {
                    $product->setRelation('supplier', (object)['name' => $companies->get($product->id % $companies->count())->name]);
                }
            }
        }
        
        $negociosCatalogo = [
            'Distribuidora Alimentos Norte',
            'Comercial San José',
            'Agroindustria del Norte',
            'Abastos Central Estelí',
            'Mercadito El Sol',
            'Importadora Las Segovias',
            'Distribuidora La Favorita',
            'Suplidora Nicaragüense'
        ];
        
        $supplierName = $inventario?->supplier?->name ?? $product->supplier?->name;
        if (empty($supplierName) || strtolower($supplierName) === 'singki' || strtolower($supplierName) === 'wawastech') {
            $assignedName = $negociosCatalogo[$product->id % count($negociosCatalogo)];
            if ($inventario?->supplier) {
                $inventario->supplier->name = $assignedName;
            } elseif ($product->supplier) {
                $product->supplier->name = $assignedName;
            } else {
                $product->setRelation('supplier', (object)['name' => $assignedName]);
            }
        }

        return view('usuario.reservar', ['producto' => $product, 'inventario' => $inventario]);
    })->name('usuario.producto.reservar');

    Route::post('/producto/{product}/reservar', function (\Illuminate\Http\Request $request, \App\Models\Product $product) {
        $request->validate([
            'notes' => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'unidad' => 'required|string',
            'delivery_address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        
        $inventario = \App\Models\Inventory::with('supplier')->where('product_id', $product->id)->first();
        $supplier = $inventario?->supplier ?? $product->supplier;
        
        if (!$supplier) {
            $suppliers = \App\Models\Supplier::all();
            if ($suppliers->count() > 0) {
                $supplier = $suppliers->get($product->id % $suppliers->count());
            } else {
                $companies = \App\Models\Company::where('name', '!=', 'wawastech')->get();
                $company = $companies->count() > 0 ? $companies->get($product->id % $companies->count()) : \App\Models\Company::first();
                
                $supplier = \App\Models\Supplier::create([
                    'name'                => $company->name ?? 'Distribuidora Oficial SINGKI',
                    'age'                 => 30,
                    'gender'              => 'N/A',
                    'address'             => $company->address ?? 'Managua, Nicaragua',
                    'email'               => $company->email ?? ('proveedor' . rand(100,999) . '@singki.com'),
                    'telephone'           => rand(80000000, 89999999),
                    'identification_card' => '001-' . rand(100000, 999999) . '-0001A',
                    'company'             => $company->name ?? 'SINGKI B2B',
                    'code_company'        => 'SUP-' . strtoupper(\Illuminate\Support\Str::random(5)),
                    'No_INSS'             => 'INSS-' . rand(10000, 99999),
                ]);
            }
        }
        
        $negociosCatalogo = [
            'Distribuidora Alimentos Norte',
            'Comercial San José',
            'Agroindustria del Norte',
            'Abastos Central Estelí',
            'Mercadito El Sol',
            'Importadora Las Segovias',
            'Distribuidora La Favorita',
            'Suplidora Nicaragüense'
        ];

        $finalSupplierName = $supplier->name;
        if (empty($finalSupplierName) || strtolower($finalSupplierName) === 'singki' || strtolower($finalSupplierName) === 'wawastech') {
            $finalSupplierName = $negociosCatalogo[$product->id % count($negociosCatalogo)];
            // Optionally we could update $supplier->name in DB but let's just use it for the session
        }

        $cantidad = $request->cantidad;
        $unidad = $request->unidad;
        $cost = $product->cost ?? $product->price ?? 0;
        $totalAmount = $cost * $cantidad;
        $delivery = $request->delivery_address;
        
        $lat = $request->latitude ? round((float)$request->latitude, 5) : null;
        $lng = $request->longitude ? round((float)$request->longitude, 5) : null;

        $notaCorta = ($request->notes ?? '') . " | Prod: " . ($product->name ?? '') . " x" . $cantidad;
        $special_requests_safe = \Illuminate\Support\Str::limit($notaCorta, 45, '');

        $booking = \App\Models\Booking::create([
            'date_booking'    => now()->toDateString(),
            'total_amount'    => $totalAmount,
            'deposit_amount'  => 0,
            'payment_method'  => 'En espera',
            'special_requests'=> $special_requests_safe,
            'supplier_id'     => $supplier->id,
        ]);

        $metaData = [
            'product_name' => $product->name,
            'quantity' => $cantidad,
            'unit' => $unidad,
            'delivery_address' => $delivery,
            'latitude' => $lat,
            'longitude' => $lng,
            'notes' => $request->notes,
            'total_amount' => $totalAmount,
            'supplier_name' => $finalSupplierName
        ];
        
        session()->put("booking_meta_{$booking->id}", $metaData);
        
        $metaPath = storage_path('app/booking_meta.json');
        $allMetas = file_exists($metaPath) ? json_decode(file_get_contents($metaPath), true) : [];
        if (!is_array($allMetas)) $allMetas = [];
        $allMetas[$booking->id] = $metaData;
        file_put_contents($metaPath, json_encode($allMetas, JSON_PRETTY_PRINT));

        return redirect()->route('usuario.reserva.exito', [
            'booking' => $booking->id
        ]);
    })->name('usuario.producto.reservar.store');

    Route::get('/reserva/{booking}/exito', function (\Illuminate\Http\Request $request, \App\Models\Booking $booking) {
        $booking->load('supplier');
        $product_name = $request->query('p', 'Producto reservado');
        $booking->product = (object)['name' => $product_name];
        
        return view('usuario.reserva-exito', ['reserva' => $booking]);
    })->name('usuario.reserva.exito');

    Route::resource('orders', OrderController::class);
    Route::resource('buy_verifications', Buy_verificationController::class);
    Route::get('/chat/proveedor', function () { return view('usuario.chat'); })->name('usuario.chat.proveedor');
    Route::resource('bookings', BookingController::class);
    Route::resource('contact_requests', Contact_requestController::class)->except(['create', 'store']);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('trades', TradeController::class);
    Route::get('/premium/success', [PremiumController::class, 'success'])->name('premium.success');
});

require __DIR__.'/auth.php';