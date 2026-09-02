<?php
$companyFile = 'app/Models/Company.php';
$companyContent = file_get_contents($companyFile);

// Add inventories relation if it doesn't exist
if (strpos($companyContent, 'public function inventories()') === false) {
    // We will add it before the last closing brace
    $inventoryRel = <<<PHP

    public function inventories()
    {
        return \$this->hasMany(Inventory::class, 'supplier_id');
    }

PHP;
    $companyContent = preg_replace('/}\s*$/', $inventoryRel . "}\n", $companyContent);
    file_put_contents($companyFile, $companyContent);
}

$profileFile = 'resources/views/public/profile.blade.php';
$profileContent = file_get_contents($profileFile);

// Replace $company->products with $company->inventories
$profileContent = str_replace('$company->products()', '$company->inventories()', $profileContent);
$profileContent = str_replace('$company->products', '$company->inventories', $profileContent);

// Update variables inside the forelse loop
// In the profile.blade.php we previously wrote: 
// {{ urlencode($item->name) }} -> {{ urlencode($item->product->name ?? 'Producto') }}
// {{ $item->name }} -> {{ $item->product->name ?? 'Producto sin nombre' }}
// {{ $item->code_bar }} -> {{ $item->product->code_bar ?? '' }}
// {{ $item->brand->name ?? 'N/A' }} -> {{ $item->product->brand->name ?? 'N/A' }}
// {{ number_format($item->cost ?? 0, 2) }} -> {{ number_format($item->unit_cost ?? 0, 2) }}

$profileContent = str_replace('{{ urlencode($item->name) }}', '{{ urlencode($item->product->name ?? \'P\') }}', $profileContent);
$profileContent = str_replace('{{ $item->name }}', '{{ $item->product->name ?? \'Producto\' }}', $profileContent);
$profileContent = str_replace('$item->code_bar', '$item->product->code_bar', $profileContent);
$profileContent = str_replace('$item->brand->name', '$item->product->brand->name', $profileContent);
$profileContent = preg_replace('/\$item->cost\b/', '$item->unit_cost', $profileContent);


file_put_contents($profileFile, $profileContent);
echo "Company and Profile patched successfully.\n";
?>
