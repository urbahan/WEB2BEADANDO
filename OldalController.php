<?php

namespace App\Http\Controllers;

use App\Models\Helyseg;
use App\Models\Szalloda;
use App\Models\Tavasz;

class OldalController extends Controller
{
    public function fooldal()
    {
        $helysegekSzama = Helyseg::count();
        $szallodakSzama = Szalloda::count();
        $ajanlatokSzama = Tavasz::count();

        $ajanlatok = Tavasz::with('szalloda.helyseg')
            ->orderBy('ar')
            ->take(6)
            ->get();

        return view('oldalak.fooldal', compact(
            'helysegekSzama',
            'szallodakSzama',
            'ajanlatokSzama',
            'ajanlatok'
        ));
    }

    public function adatbazis()
    {
        $helysegek = Helyseg::with('szallodak')->orderBy('nev')->get();
        $szallodak = Szalloda::with('helyseg')->orderBy('nev')->get();
        $tavasziAjanlatok = Tavasz::with('szalloda.helyseg')
            ->orderBy('indulas')
            ->take(35)
            ->get();

        return view('oldalak.adatbazis', compact('helysegek', 'szallodak', 'tavasziAjanlatok'));
    }
}
