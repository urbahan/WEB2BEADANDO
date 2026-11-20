@extends('komponensek.elrendezes')
@section('cim', 'Üzenetek – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">BEJELENTKEZETT FELHASZNÁLÓK</span><h1>Beérkezett üzenetek</h1><p>Az üzenetek a legfrissebbtől a legrégebbi felé rendezve jelennek meg.</p></div></section>
<div class="container section-block">
    @forelse($uzenetek as $uzenet)
        <article class="message-card"><div class="message-heading"><div><span class="eyebrow eyebrow-dark">{{ $uzenet->email }}</span><h3>{{ $uzenet->targy }}</h3></div><time>{{ $uzenet->created_at?->format('Y. m. d. H:i') }}</time></div><p class="mb-1"><b>{{ $uzenet->nev }}</b></p><p class="mb-0">{{ $uzenet->uzenet }}</p></article>
    @empty
        <div class="empty-state"><span>✉</span><h2>Még nincs üzenet</h2><p>A kapcsolat űrlapon érkező üzenetek itt fognak megjelenni.</p></div>
    @endforelse
</div>
@endsection
