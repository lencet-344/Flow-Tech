<?php
$file = 'resources/views/public/profile.blade.php';
$content = file_get_contents($file);

$salvavidas = <<<'PHP'
@php
    // Salvavidas: Si el controlador no manda la variable, tomamos la del usuario actual o la primera que exista.
    if (!isset($company)) {
        try {
            $company = \App\Models\Company::where('user_id', auth()->id())->first() ?? \App\Models\Company::first();
        } catch(\Exception $e) {
            $company = \App\Models\Company::first();
        }
    }
@endphp

PHP;

// Inject at line 1
$content = $salvavidas . $content;

// I already used `@if(isset($company->products) && $company->products->count() > 0)` and `@foreach($company->products as $item)` but let's make sure I'm using null safe operators everywhere for $company just in case it's completely empty.
// Wait, if $company is retrieved via `Company::first()`, it won't be null unless the DB is empty. If it's empty, we should fallback to a new Company.
$salvavidas = <<<'PHP'
@php
    // Salvavidas: Si el controlador no manda la variable, tomamos la del usuario actual o la primera que exista.
    if (!isset($company)) {
        try {
            $company = \App\Models\Company::where('user_id', auth()->id())->first() ?? \App\Models\Company::first() ?? new \App\Models\Company();
        } catch(\Exception $e) {
            $company = \App\Models\Company::first() ?? new \App\Models\Company();
        }
    }
@endphp

PHP;

// Let's replace the top again
$content = file_get_contents($file);
$content = preg_replace('/^@php.*?@endphp\s*/s', '', $content); // remove previous if exists
$content = $salvavidas . $content;

file_put_contents($file, $content);
echo "Injected salvavidas\n";
?>
