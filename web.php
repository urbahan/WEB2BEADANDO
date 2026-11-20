<?php

use App\Http\Controllers\BelepesController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\OldalController;
use App\Http\Controllers\SzallodaController;
use App\Http\Controllers\UzenetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OldalController::class, 'fooldal'])->name('fooldal');
Route::get('/adatbazis', [OldalController::class, 'adatbazis'])->name('adatbazis');
Route::get('/diagram', [ChartController::class, 'index'])->name('diagram');
Route::get('/kapcsolat', [UzenetController::class, 'urlap'])->name('kapcsolat');
Route::post('/kapcsolat', [UzenetController::class, 'mentes'])->name('uzenet.mentes');

Route::middleware('guest')->group(function () {
    Route::get('/regisztracio', [BelepesController::class, 'regisztracio'])->name('regisztracio');
    Route::post('/regisztracio', [BelepesController::class, 'regisztracioMentes'])->name('regisztracio.mentes');
    Route::get('/belepes', [BelepesController::class, 'belepes'])->name('belepes');
    Route::post('/belepes', [BelepesController::class, 'belepesEllenorzes'])->name('belepes.ellenorzes');
});

Route::post('/kilepes', [BelepesController::class, 'kilepes'])
    ->middleware('auth')
    ->name('kilepes');

Route::get('/uzenetek', [UzenetController::class, 'lista'])
    ->middleware('auth')
    ->name('uzenetek');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('szallodak', SzallodaController::class)
            ->parameters(['szallodak' => 'szalloda'])
            ->except(['show']);
    });
