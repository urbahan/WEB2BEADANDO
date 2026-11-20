@extends('komponensek.elrendezes')
@section('cim', 'Főoldal – Napfény Tours')
@section('tartalom')
<section class="hero-section">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow">UTAZZ VELÜNK!</span>
            <h1>Találd meg a következő <em>napfényes</em> élményedet.</h1>
            <p>Fedezd fel a Napfény Tours szállodáit és a tavaszi utazási adatbázis ajánlatait egy helyen.</p>
            <div class="hero-actions">
                <a class="btn btn-sun" href="{{ route('adatbazis') }}">Ajánlatok megtekintése</a>
                <a class="btn btn-outline-light" href="{{ route('kapcsolat') }}">Kapcsolat</a>
            </div>
            <div class="hero-note">Az oldalon megjelenő ajánlatok a 2011-es oktatási adatállományból származnak.</div>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="sun"></div><div class="sea sea-one"></div><div class="sea sea-two"></div>
            <div class="palm palm-left">♣</div><div class="palm palm-right">♣</div>
            <div class="art-label"><span>☀</span><div><b>Napfényes pihenés</b><small>Élmények egy helyen</small></div></div>
        </div>
    </div>
</section>
<section class="container stats-row" aria-label="Adatbázis összesítő">
    <div class="stat-card"><strong>{{ $helysegekSzama }}</strong><span>település</span></div>
    <div class="stat-card"><strong>{{ $szallodakSzama }}</strong><span>szálloda</span></div>
    <div class="stat-card"><strong>{{ $ajanlatokSzama }}</strong><span>tavaszi ajánlat</span></div>
</section>
<section class="container section-block">
    <div class="section-heading"><div><span class="eyebrow eyebrow-dark">KEDVENC AJÁNLATAINK</span><h2>Válogatás a tavaszi adatbázisból</h2></div><a class="text-link" href="{{ route('adatbazis') }}">Teljes adatbázis →</a></div>
    <div class="row g-4">
        @forelse($ajanlatok as $ajanlat)
            <div class="col-md-6 col-lg-4">
                <article class="offer-card h-100">
                    <div class="offer-icon">✦</div>
                    <div class="offer-stars">{{ str_repeat('★', (int) ($ajanlat->szalloda?->besorolas ?? 0)) }}</div>
                    <h3>{{ $ajanlat->szalloda?->nev ?? 'Szálloda' }}</h3>
                    <p>{{ $ajanlat->szalloda?->helyseg?->nev ?? 'Ismeretlen település' }} · {{ $ajanlat->idotartam }} nap</p>
                    <div class="offer-bottom"><strong>{{ number_format($ajanlat->ar, 0, ',', ' ') }} Ft</strong><span>{{ $ajanlat->indulas?->format('Y. m. d.') }}</span></div>
                </article>
            </div>
        @empty
            <div class="col-12"><p>Még nincsenek betöltött ajánlatok. Futtasd a migrációt és a seedert.</p></div>
        @endforelse
    </div>
</section>
<section class="cta-band"><div class="container cta-inner"><div><span class="eyebrow">KÉRDÉSED VAN?</span><h2>Segítünk megtervezni az utazásodat.</h2></div><a href="{{ route('kapcsolat') }}" class="btn btn-sun">Írj nekünk</a></div></section>
@endsection
