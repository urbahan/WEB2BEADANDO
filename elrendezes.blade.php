<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Napfény Tours – utazási ajánlatok, szállodák és információk.">
    <title>@yield('cim', 'Napfény Tours')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<header class="site-header">
    <nav class="container navbar-wrap" aria-label="Fő navigáció">
        <a class="brand" href="{{ route('fooldal') }}"><span class="brand-mark">☀</span><span>Napfény <b>Tours</b></span></a>
        <div class="nav-links">
            <a href="{{ route('fooldal') }}">Főoldal</a>
            <a href="{{ route('adatbazis') }}">Adatbázis</a>
            <a href="{{ route('kapcsolat') }}">Kapcsolat</a>
            <a href="{{ route('diagram') }}">Diagram</a>
            @auth
                <a href="{{ route('uzenetek') }}">Üzenetek</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.szallodak.index') }}">CRUD / Admin</a>
                @endif
                <form method="POST" action="{{ route('kilepes') }}" class="nav-form">
                    @csrf
                    <button type="submit" class="nav-button">Kijelentkezés</button>
                </form>
            @else
                <a href="{{ route('belepes') }}">Bejelentkezés</a>
                <a href="{{ route('regisztracio') }}" class="nav-register">Regisztráció</a>
            @endauth
        </div>
    </nav>
</header>

<main>
    @if(session('siker'))
        <div class="container pt-3"><div class="alert alert-success mb-0" role="status">{{ session('siker') }}</div></div>
    @endif
    @yield('tartalom')
</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <div><a class="footer-brand" href="{{ route('fooldal') }}">☀ Napfény Tours</a><p>Utazás élményekkel – 2011-es mintadatok alapján.</p></div>
        <div class="footer-makers">Készítők: [1. készítő neve – NEPTUN] · [2. készítő neve – NEPTUN]</div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
