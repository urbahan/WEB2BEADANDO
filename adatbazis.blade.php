@extends('komponensek.elrendezes')
@section('cim', 'Adatbázis – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">ADATBÁZIS</span><h1>Utazási adatok</h1><p>A három forrástábla adatai ORM-kapcsolatokon keresztül jelennek meg.</p></div></section>
<div class="container section-block">
    <div class="notice-box"><b>Fontos:</b> ezek történeti, 2011-es mintadatok, nem jelenleg foglalható utazási ajánlatok.</div>
    <div class="section-heading mt-5"><div><span class="eyebrow eyebrow-dark">1. TÁBLA</span><h2>Települések</h2></div><span class="count-pill">{{ $helysegek->count() }} rekord</span></div>
    <div class="table-responsive data-table-wrap"><table class="table table-hover align-middle"><thead><tr><th>Azonosító</th><th>Település</th><th>Ország</th><th>Szállodák</th></tr></thead><tbody>
    @foreach($helysegek as $helyseg)<tr><td>{{ $helyseg->az }}</td><td><b>{{ $helyseg->nev }}</b></td><td>{{ $helyseg->orszag }}</td><td>{{ $helyseg->szallodak->count() }}</td></tr>@endforeach
    </tbody></table></div>

    <div class="section-heading mt-5"><div><span class="eyebrow eyebrow-dark">2. TÁBLA</span><h2>Szállodák</h2></div><span class="count-pill">{{ $szallodak->count() }} rekord</span></div>
    <div class="table-responsive data-table-wrap"><table class="table table-hover align-middle"><thead><tr><th>Azonosító</th><th>Szálloda</th><th>Település</th><th>Besorolás</th><th>Tengerpart</th><th>Repülőtér</th><th>Félpanzió</th></tr></thead><tbody>
    @foreach($szallodak as $szalloda)<tr><td>{{ $szalloda->az }}</td><td><b>{{ $szalloda->nev }}</b></td><td>{{ $szalloda->helyseg?->nev }}</td><td>{{ $szalloda->besorolas }} ★</td><td>{{ $szalloda->tengerpart_tav }} m</td><td>{{ $szalloda->repter_tav }} km</td><td>{{ $szalloda->felpanzio ? 'Igen' : 'Nem' }}</td></tr>@endforeach
    </tbody></table></div>

    <div class="section-heading mt-5"><div><span class="eyebrow eyebrow-dark">3. TÁBLA</span><h2>Tavaszi ajánlatok – első 35 rekord</h2></div><span class="count-pill">{{ $tavasziAjanlatok->count() }} megjelenített rekord</span></div>
    <div class="table-responsive data-table-wrap"><table class="table table-hover align-middle"><thead><tr><th>Szálloda</th><th>Település</th><th>Indulás</th><th>Időtartam</th><th>Ár</th></tr></thead><tbody>
    @foreach($tavasziAjanlatok as $ajanlat)<tr><td>{{ $ajanlat->szalloda?->nev }}</td><td>{{ $ajanlat->szalloda?->helyseg?->nev }}</td><td>{{ $ajanlat->indulas?->format('Y. m. d.') }}</td><td>{{ $ajanlat->idotartam }} nap</td><td><b>{{ number_format($ajanlat->ar, 0, ',', ' ') }} Ft</b></td></tr>@endforeach
    </tbody></table></div>
</div>
@endsection
