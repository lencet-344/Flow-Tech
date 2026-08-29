<?php
$ofertas = file_get_contents('resources/views/admin/ofertas.blade.php');
$startPos = strpos($ofertas, '<!-- LISTA DE OFERTAS -->');
$endPos = strpos($ofertas, '</div>', strrpos($ofertas, '<!-- Tarjeta 2: Oferta Inactiva -->'));
$endPos = strpos($ofertas, '</div>', $endPos + 1);

$loopContent = <<<'HTML'
<!-- LISTA DE OFERTAS -->
    <div class="flex flex-col gap-4">
        @forelse($offers ?? [] as $offer)
        <!-- Tarjeta -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <!-- Informacion -->
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-lg font-medium text-[#040116]">{{ $offer->title ?? 'Sin título' }}</h3>
                    <span class="bg-[#dcfce7] text-[#16a34a] px-3 py-1 rounded-full text-xs font-medium">Activa</span>
                    <span class="bg-[#eff6ff] text-[#2563eb] px-3 py-1 rounded-full text-xs font-medium">{{ $offer->discount ?? '0' }}%</span>
                </div>
                <p class="text-gray-500 text-sm mb-1">{{ $offer->description ?? 'Sin descripción' }}</p>
            </div>
            <!-- Acciones -->
            <div class="flex items-center gap-3 shrink-0">
                <form action="{{ route('offers.destroy', $offer->id ?? 0) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 text-red-500 font-medium px-5 py-2 rounded-xl text-sm hover:bg-red-100 transition">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500 bg-white rounded-2xl border border-gray-100 shadow-sm">No hay ofertas creadas</div>
        @endforelse
HTML;

$newOfertas = substr($ofertas, 0, $startPos) . $loopContent . substr($ofertas, $endPos);
file_put_contents('resources/views/offers/index.blade.php', $newOfertas);

echo "Offers fixed!\n";
?>
