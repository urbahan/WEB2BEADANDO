@extends('komponensek.elrendezes')
@section('cim', 'Bejelentkezés – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">ÜDV ÚJRA!</span><h1>Bejelentkezés</h1><p>Lépj be, hogy megtekinthesd az üzeneteket és az adminisztrációt.</p></div></section>
<div class="container section-block narrow-container">
    @if($errors->any())<div class="alert alert-danger">@foreach($errors->all() as $hiba)<div>{{ $hiba }}</div>@endforeach</div>@endif
    <form method="POST" action="{{ route('belepes.ellenorzes') }}" class="form-card">@csrf
        <div class="mb-3"><label class="form-label" for="email">E-mail-cím</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus></div>
        <div class="mb-3"><label class="form-label" for="password">Jelszó</label><input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required></div>
        <div class="form-check mb-4"><input class="form-check-input" type="checkbox" id="emlekezz" name="emlekezz" value="1"><label class="form-check-label" for="emlekezz">Emlékezz rám</label></div>
        <button class="btn btn-sun" type="submit">Bejelentkezés</button>
        <p class="mt-3 mb-0">Még nincs fiókod? <a href="{{ route('regisztracio') }}">Regisztrálj itt.</a></p>
    </form>
</div>
@endsection
