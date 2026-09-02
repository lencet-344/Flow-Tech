<?php
// 1. Update User model
$userModelFile = 'app/Models/User.php';
$userModelContent = file_get_contents($userModelFile);
if (strpos($userModelContent, "'status'") === false) {
    $userModelContent = str_replace("'role'", "'role',\n        'status'", $userModelContent);
    file_put_contents($userModelFile, $userModelContent);
}

// 2. Update routes
$routesFile = 'routes/web.php';
$routesContent = file_get_contents($routesFile);
$routeSearch = "Route::get('/superadmin/usuarios', function () { return view('superadmin.users'); })->name('superadmin.users');";
$routeReplace = <<<PHP
Route::get('/superadmin/usuarios', function () { 
        \$users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('superadmin.users', compact('users')); 
    })->name('superadmin.users');
    
    Route::patch('/superadmin/usuarios/{id}/toggle-status', function (\$id) {
        \$user = \App\Models\User::findOrFail(\$id);
        \$user->status = \$user->status === 'suspendido' ? 'activo' : 'suspendido';
        \$user->save();
        return back()->with('success', 'Estado actualizado');
    })->name('admin.users.toggleStatus');
PHP;

if (strpos($routesContent, 'toggle-status') === false) {
    $routesContent = str_replace($routeSearch, $routeReplace, $routesContent);
    file_put_contents($routesFile, $routesContent);
}

// 3. Update view
$viewFile = 'resources/views/superadmin/users.blade.php';
$viewContent = file_get_contents($viewFile);

$tbodySearchRegex = '/<tbody[^>]*id="tabla-usuarios"[^>]*>.*?<\/tbody>/is';
$tbodyReplace = <<<'HTML'
<tbody class="text-[13px] text-gray-700 divide-y divide-gray-50" id="tabla-usuarios">
                    @forelse($users as $user)
                    <tr class="user-row hover:bg-gray-50/50 transition" data-rol="{{ strtolower($user->role) }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span class="font-medium text-[#040116]">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if(strtolower($user->role) === 'cliente')
                                <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-xs font-semibold">Cliente</span>
                            @elseif(strtolower($user->role) === 'proveedor')
                                <span class="bg-emerald-50 text-emerald-600 px-4 py-1.5 rounded-full text-xs font-semibold">Proveedor</span>
                            @else
                                <span class="bg-gray-50 text-gray-600 px-4 py-1.5 rounded-full text-xs font-semibold">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if(($user->status ?? 'activo') === 'activo')
                                <span class="bg-green-50 text-green-500 px-4 py-1.5 rounded-full text-xs font-semibold">Activo</span>
                            @else
                                <span class="bg-red-50 text-red-500 px-4 py-1.5 rounded-full text-xs font-semibold">Suspendido</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                @if(($user->status ?? 'activo') === 'activo')
                                    <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-100 px-4 py-1.5 rounded-md text-xs font-semibold transition">Suspender</button>
                                @else
                                    <button type="submit" class="bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 rounded-md text-xs font-semibold transition">Reactivar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">No hay usuarios registrados en el sistema.</td>
                    </tr>
                    @endforelse
                </tbody>
HTML;

$viewContent = preg_replace($tbodySearchRegex, $tbodyReplace, $viewContent);
file_put_contents($viewFile, $viewContent);

echo "SuperAdmin Users Table completely wired.\n";
?>
