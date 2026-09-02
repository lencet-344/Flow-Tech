<?php
// 1. Update Inventory model
$inventoryModelFile = 'app/Models/Inventory.php';
$content = file_get_contents($inventoryModelFile);
if (strpos($content, 'public function company()') === false) {
    $companyRel = <<<PHP

    public function company()
    {
        return \$this->belongsTo(Company::class, 'supplier_id');
    }

PHP;
    $content = preg_replace('/}\s*$/', $companyRel . "}\n", $content);
    file_put_contents($inventoryModelFile, $content);
}

// 2. Update publications view
$file = 'resources/views/superadmin/publications.blade.php';
$viewContent = file_get_contents($file);

// Add @php block
if (strpos($viewContent, '$publications =') === false) {
    $phpBlock = <<<'HTML'
@php
    $publications = \App\Models\Inventory::with(['product', 'company'])->orderBy('created_at', 'desc')->get();
    $totalContent = $publications->count();
    $reportedCount = 0;
    $approvedCount = $totalContent;
@endphp

HTML;
    $viewContent = preg_replace('/@section\(\'content\'\)/', "@section('content')\n" . $phpBlock, $viewContent);
}

// Replace top metric cards
$viewContent = preg_replace(
    '/<div class="text-\[32px\] font-bold text-blue-600 leading-none mb-1">\d+<\/div>/',
    '<div class="text-[32px] font-bold text-blue-600 leading-none mb-1">{{ $totalContent }}</div>',
    $viewContent
);
$viewContent = preg_replace(
    '/<div class="text-\[32px\] font-bold text-red-600 leading-none mb-1">\d+<\/div>/',
    '<div class="text-[32px] font-bold text-red-600 leading-none mb-1">{{ $reportedCount }}</div>',
    $viewContent
);
$viewContent = preg_replace(
    '/<div class="text-\[32px\] font-bold text-green-700 leading-none mb-1">\d+<\/div>/',
    '<div class="text-[32px] font-bold text-green-700 leading-none mb-1">{{ $approvedCount }}</div>',
    $viewContent
);

// Replace tbody
$tbodyRegex = '/<tbody[^>]*>.*?<\/tbody>/is';
$tbodyReplace = <<<'HTML'
<tbody class="text-[13.5px] text-gray-800 divide-y divide-gray-50">
                    @forelse($publications as $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->product->name ?? 'Producto') }}&background=random" alt="Foto principal" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                <span class="font-medium text-gray-900">{{ $item->product->name ?? 'Sin nombre' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-blue-600 hover:underline cursor-pointer">
                            @if($item->company)
                                <a href="{{ url('/companies/' . $item->company->id) }}" target="_blank">{{ $item->company->name }}</a>
                            @else
                                Desconocido
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-semibold">Producto</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-50 text-green-500 px-4 py-1.5 rounded-full text-xs font-semibold">OK</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">Moderar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12">
                            <div class="p-8 text-center text-gray-500">No hay publicaciones recientes.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
HTML;

$viewContent = preg_replace($tbodyRegex, $tbodyReplace, $viewContent);
file_put_contents($file, $viewContent);

echo "Publications view wired successfully.\n";
?>
