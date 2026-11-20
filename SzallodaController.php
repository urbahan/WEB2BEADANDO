<?php

namespace App\Http\Controllers;

use App\Models\Helyseg;
use App\Models\Szalloda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SzallodaController extends Controller
{
    public function index(): View
    {
        $szallodak = Szalloda::with('helyseg')->orderBy('nev')->get();

        return view('szallodak.index', compact('szallodak'));
    }

    public function create(): View
    {
        $szalloda = new Szalloda();
        $helysegek = Helyseg::orderBy('nev')->get();

        return view('szallodak.uj', compact('szalloda', 'helysegek'));
    }

    public function store(Request $request): RedirectResponse
    {
        Szalloda::create($this->ellenorzes($request));

        return redirect()->route('admin.szallodak.index')->with('siker', 'Az új szálloda elmentve.');
    }

    public function edit(Szalloda $szalloda): View
    {
        $helysegek = Helyseg::orderBy('nev')->get();

        return view('szallodak.szerkeszt', compact('szalloda', 'helysegek'));
    }

    public function update(Request $request, Szalloda $szalloda): RedirectResponse
    {
        $szalloda->update($this->ellenorzes($request, $szalloda));

        return redirect()->route('admin.szallodak.index')->with('siker', 'A szálloda adatai módosultak.');
    }

    public function destroy(Szalloda $szalloda): RedirectResponse
    {
        $szalloda->delete();

        return redirect()->route('admin.szallodak.index')->with('siker', 'A szálloda és a hozzá tartozó tavaszi ajánlatok törlődtek.');
    }

    private function ellenorzes(Request $request, ?Szalloda $szalloda = null): array
    {
        $azonositoSzabaly = $szalloda
            ? ['required', 'in:'.$szalloda->az]
            : ['required', 'string', 'alpha_num', 'max:5', 'unique:szallodak,az'];

        return $request->validate([
            'az' => $azonositoSzabaly,
            'nev' => ['required', 'string', 'max:150'],
            'besorolas' => ['required', 'integer', 'min:1', 'max:5'],
            'helyseg_az' => ['required', 'string', 'exists:helysegek,az'],
            'tengerpart_tav' => ['required', 'integer', 'min:0', 'max:100000'],
            'repter_tav' => ['required', 'integer', 'min:0', 'max:100000'],
            'felpanzio' => ['required', 'boolean'],
        ], [
            'az.required' => 'A szálloda azonosítója kötelező.',
            'az.alpha_num' => 'Az azonosító csak betűt és számot tartalmazhat.',
            'helyseg_az.exists' => 'Válassz egy létező települést.',
            'besorolas.min' => 'A besorolás 1 és 5 csillag között lehet.',
            'besorolas.max' => 'A besorolás 1 és 5 csillag között lehet.',
        ]);
    }
}
