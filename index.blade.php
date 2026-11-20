@extends('komponensek.elrendezes')
@section('cim', 'Szállodák kezelése – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">ADMINISZTRÁCIÓ</span><h1>Szállodák kezelése</h1><p>Új rekord felvétele, meglévő szálloda szerkesztése vagy törlése.</p></div></section>
<div class="container section-block">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4"><h2 class="mb-0">Szállodák</h2><a class="btn btn-sun" href="{{ route('admin.szallodak.create') }}">+ Új szálloda</a></div>
    @if($szallodak->isEmpty())<p>Még nincs szálloda az adatbázisban.</p>@else
    <div class="table-responsive data-table-wrap"><table class="table table-hover align-middle"><thead><tr><th>Azonosító</th><th>Szálloda</th><th>Település</th><th>Besorolás</th><th>Félpanzió</th><th>Műveletek</th></tr></thead><tbody>
    @foreach($szallodak as $szalloda)
        <tr><td>{{ $szalloda->az }}</td><td><b>{{ $szalloda->nev }}</b></td><td>{{ $szalloda->helyseg?->nev }}</td><td>{{ $szalloda->besorolas }} ★</td><td>{{ $szalloda->felpanzio ? 'Igen' : 'Nem' }}</td><td class="actions-cell"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.szallodak.edit', $szalloda) }}">Szerkesztés</a><form method="POST" action="{{ route('admin.szallodak.destroy', $szalloda) }}" onsubmit="return confirm('Biztosan törlöd ezt a szállodát és a hozzá tartozó ajánlatokat?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit">Törlés</button></form></td></tr>
    @endforeach
    </tbody></table></div>
    @endif
</div>
@endsection
