@extends('komponensek.elrendezes')
@section('cim', 'Regisztráció – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">CSATLAKOZZ HOZZÁNK</span><h1>Regisztráció</h1><p>A regisztrált látogatók megtekinthetik az üzenetek menüpontot.</p></div></section>
<div class="container section-block narrow-container">
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $hiba)<li>{{ $hiba }}</li>@endforeach</ul></div>@endif
    <form method="POST" action="{{ route('regisztracio.mentes') }}" class="form-card">@csrf
        <div class="mb-3"><label class="form-label" for="name">Név</label><input class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required></div>
        <div class="mb-3"><label class="form-label" for="email">E-mail-cím</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required></div>
        <div class="mb-3"><label class="form-label" for="password">Jelszó (legalább 8 karakter)</label><input class="form-control" id="password" name="password" type="password" autocomplete="new-password" required></div>
        <div class="mb-4"><label class="form-label" for="password_confirmation">Jelszó újra</label><input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required></div>
        <button class="btn btn-sun" type="submit">Regisztráció</button>
    </form>
</div>
@endsection
