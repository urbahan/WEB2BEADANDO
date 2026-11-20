@extends('komponensek.elrendezes')
@section('cim', 'Kapcsolat – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">KAPCSOLAT</span><h1>Írj nekünk!</h1><p>Küldd el kérdésedet az űrlapon. Az üzenetet az alkalmazás elmenti az adatbázisba.</p></div></section>
<div class="container section-block narrow-container">
    @if($errors->any())<div class="alert alert-danger"><b>Kérjük, javítsd a következő hibákat:</b><ul class="mb-0 mt-2">@foreach($errors->all() as $hiba)<li>{{ $hiba }}</li>@endforeach</ul></div>@endif
    <form method="POST" action="{{ route('uzenet.mentes') }}" class="form-card">@csrf
        <div class="mb-3"><label for="nev" class="form-label">Név</label><input class="form-control" id="nev" name="nev" value="{{ old('nev', auth()->user()->name ?? '') }}" maxlength="100" required></div>
        <div class="mb-3"><label for="email" class="form-label">E-mail-cím</label><input class="form-control" type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" maxlength="255" required></div>
        <div class="mb-3"><label for="targy" class="form-label">Tárgy</label><input class="form-control" id="targy" name="targy" value="{{ old('targy') }}" maxlength="150" required></div>
        <div class="mb-4"><label for="uzenet" class="form-label">Üzenet</label><textarea class="form-control" id="uzenet" name="uzenet" rows="6" maxlength="3000" required>{{ old('uzenet') }}</textarea></div>
        <button class="btn btn-sun" type="submit">Üzenet küldése</button>
    </form>
</div>
@endsection
