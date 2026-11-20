<?php

namespace App\Http\Controllers;

use App\Models\Uzenet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UzenetController extends Controller
{
    public function urlap(): View
    {
        return view('oldalak.kapcsolat');
    }

    public function mentes(Request $request): RedirectResponse
    {
        $adatok = $request->validate([
            'nev' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'targy' => ['required', 'string', 'max:150'],
            'uzenet' => ['required', 'string', 'min:5', 'max:3000'],
        ], [
            'required' => 'A mező kitöltése kötelező.',
            'email' => 'Adj meg egy érvényes e-mail-címet.',
            'min' => 'Az üzenet legalább :min karakter legyen.',
            'max' => 'A mező legfeljebb :max karakter lehet.',
        ]);

        Uzenet::create($adatok);

        return redirect()->route('kapcsolat')->with('siker', 'Köszönjük az üzenetet! Sikeresen elmentettük.');
    }

    public function lista(): View
    {
        $uzenetek = Uzenet::orderByDesc('created_at')->get();

        return view('oldalak.uzenetek', compact('uzenetek'));
    }
}
