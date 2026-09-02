<?php
$file = 'resources/views/superadmin/businesses.blade.php';
$content = file_get_contents($file);

// 1. Add @php block at the top if it doesn't exist
if (strpos($content, '$companies =') === false) {
    $phpBlock = <<<'HTML'
@php
    $companies = \App\Models\Company::with('user')->withCount('inventories')->orderBy('created_at', 'desc')->get();
@endphp

HTML;
    // Insert after @section('content')
    $content = preg_replace('/@section\(\'content\'\)/', "@section('content')\n" . $phpBlock, $content);
}

// 2. Replace tbody
$tbodyRegex = '/<tbody[^>]*id="tabla-negocios"[^>]*>.*?<\/tbody>/is';
$tbodyReplace = <<<'HTML'
<tbody class="text-[13.5px] text-gray-700 divide-y divide-gray-50" id="tabla-negocios">
                    @forelse ($companies as $company)
                    <tr class="business-row hover:bg-gray-50/50 transition" data-estado="{{ strtolower($company->status ?? 'activo') }}">
                        <td class="px-6 py-4 font-medium text-[#040116]">{{ $company->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $company->user->name ?? 'Sin propietario' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $company->category->name ?? 'Sin categoría' }}</td>
                        <td class="px-6 py-4 font-medium">{{ $company->inventories_count ?? 0 }}</td>
                        <td class="px-6 py-4 text-gray-400">—</td>
                        <td class="px-6 py-4">
                            @if(($company->status ?? 'activo') === 'activo')
                                <span class="bg-green-50 text-green-500 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Activo</span>
                            @elseif(($company->status ?? 'activo') === 'pendiente')
                                <span class="bg-yellow-50 text-yellow-600 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Pendiente</span>
                            @else
                                <span class="bg-gray-50 text-gray-600 px-5 py-1.5 rounded-full text-[11.5px] font-bold tracking-wide w-24 inline-block text-center">Suspendido</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ url('/companies/' . $company->id) }}" target="_blank" class="bg-gray-50 text-gray-600 hover:bg-gray-100 px-3 py-1.5 rounded-md text-xs font-semibold transition border border-gray-200">Ver</a>
                                
                                <form action="{{ route('admin.companies.toggleStatus', $company->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    @if(($company->status ?? 'activo') === 'activo' || ($company->status ?? 'activo') === 'pendiente')
                                        <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">Suspender</button>
                                    @else
                                        <button type="submit" class="bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 rounded-md text-xs font-semibold transition">Activar</button>
                                    @endif
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12">
                            <div class="text-center text-gray-500">No hay negocios registrados aún.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
HTML;

$content = preg_replace($tbodyRegex, $tbodyReplace, $content);
file_put_contents($file, $content);
echo "Super Admin Businesses table successfully wired.\n";
?>
