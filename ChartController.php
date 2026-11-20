<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        $diagramAdatok = DB::table('tavasz')
            ->join('szallodak', 'tavasz.szalloda_az', '=', 'szallodak.az')
            ->select('szallodak.nev')
            ->selectRaw('ROUND(AVG(tavasz.ar)) AS atlag_ar')
            ->selectRaw('COUNT(tavasz.id) AS ajanlatok_szama')
            ->groupBy('szallodak.az', 'szallodak.nev')
            ->orderBy('szallodak.nev')
            ->get();

        return view('oldalak.diagram', compact('diagramAdatok'));
    }
}
