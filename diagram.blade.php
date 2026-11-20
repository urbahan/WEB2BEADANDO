@extends('komponensek.elrendezes')
@section('cim', 'Diagram – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">CHART.JS</span><h1>Átlagos ajánlati árak</h1><p>A diagram a tavasz és a szalloda táblák adatai alapján készül.</p></div></section>
<div class="container section-block">
    <div class="chart-card"><h2>Szállodánkénti átlagár</h2><p class="muted-text">Az értékek forintban szerepelnek, a 2011-es adatállomány alapján.</p>
        @if($diagramAdatok->isEmpty())<p>Nincs megjeleníthető diagramadat. Futtasd a seedert.</p>@else<canvas id="arDiagram" height="120" aria-label="Szállodánkénti átlagár diagram"></canvas>@endif
    </div>
</div>
@endsection
@if($diagramAdatok->isNotEmpty())
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('arDiagram');
    if (!canvas || typeof Chart === 'undefined') return;
    const labels = @json($diagramAdatok->pluck('nev')->values());
    const values = @json($diagramAdatok->pluck('atlag_ar')->map(fn ($ar) => (int) $ar)->values());
    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Átlagár (Ft)',
                data: values,
                borderWidth: 1,
                borderRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: value => new Intl.NumberFormat('hu-HU').format(value) + ' Ft' } }
            }
        }
    });
});
</script>
@endpush
@endif
