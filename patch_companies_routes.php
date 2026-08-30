<?php
$routesFile = 'routes/web.php';
$routesContent = file_get_contents($routesFile);
$routeSearch = "Route::get('/superadmin/negocios', function () { return view('superadmin.businesses'); })->name('superadmin.businesses');";
$routeReplace = <<<PHP
Route::get('/superadmin/negocios', function () { 
        return view('superadmin.businesses'); 
    })->name('superadmin.businesses');

    Route::patch('/superadmin/negocios/{id}/toggle-status', function (\$id) {
        \$company = \App\Models\Company::findOrFail(\$id);
        \$company->status = \$company->status === 'suspendido' ? 'activo' : 'suspendido';
        \$company->save();
        return back()->with('success', 'Estado del negocio actualizado');
    })->name('admin.companies.toggleStatus');
PHP;

if (strpos($routesContent, 'admin.companies.toggleStatus') === false) {
    $routesContent = str_replace($routeSearch, $routeReplace, $routesContent);
    file_put_contents($routesFile, $routesContent);
}

echo "Routes patched.\n";
?>
