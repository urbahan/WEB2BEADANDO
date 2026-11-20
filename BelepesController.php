<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BelepesController extends Controller
{
    public function regisztracio(): View
    {
        return view('auth.regisztracio');
    }

    public function regisztracioMentes(Request $request): RedirectResponse
    {
        $adatok = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'A név megadása kötelező.',
            'email.required' => 'Az e-mail-cím megadása kötelező.',
            'email.email' => 'Adj meg egy érvényes e-mail-címet.',
            'email.unique' => 'Ezzel az e-mail-címmel már regisztráltak.',
            'password.min' => 'A jelszó legalább 8 karakter legyen.',
            'password.confirmed' => 'A két jelszó nem egyezik.',
        ]);

        // A regisztrációval létrejövő felhasználó mindig normál látogató (role=2).
        $user = User::create([
            'name' => $adatok['name'],
            'email' => $adatok['email'],
            'password' => $adatok['password'],
            'role' => 2,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('fooldal')->with('siker', 'Sikeres regisztráció! Bejelentkeztél.');
    }

    public function belepes(): View
    {
        return view('auth.belepes');
    }

    public function belepesEllenorzes(Request $request): RedirectResponse
    {
        $adatok = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($adatok, $request->boolean('emlekezz'))){
            $request->session()->regenerate();

            return redirect()->intended(route('fooldal'))->with('siker', 'Sikeres bejelentkezés!');
        }

        return back()
            ->withErrors(['email' => 'Hibás e-mail-cím vagy jelszó.'])
            ->onlyInput('email');
    }

    public function kilepes(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('fooldal')->with('siker', 'Sikeresen kijelentkeztél.');
    }
}
