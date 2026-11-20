@extends('komponensek.elrendezes')
@section('cim', 'Új szálloda – Napfény Tours')
@section('tartalom')
<section class="page-hero"><div class="container"><span class="eyebrow">ADMINISZTRÁCIÓ</span><h1>Új szálloda felvétele</h1></div></section>
<div class="container section-block narrow-container">
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $hiba)<li>{{ $hiba }}</li>@endforeach</ul></div>@endif
    <form method="POST" action="{{ route('admin.szallodak.store') }}" class="form-card">@csrf @include('szallodak._mezo')<button class="btn btn-sun" type="submit">Mentés</button> <a class="btn btn-outline-secondary" href="{{ route('admin.szallodak.index') }}">Mégsem</a></form>
</div>
@endsection
