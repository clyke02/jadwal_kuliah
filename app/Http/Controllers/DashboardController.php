<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalDosen = $user->dosens()->count();
        $totalMataKuliah = $user->mataKuliahs()->count();
        $totalRuangan = $user->ruangans()->count();
        $totalJadwal = $user->jadwals()->count();

        return view('dashboard', compact(
            'totalDosen',
            'totalMataKuliah',
            'totalRuangan',
            'totalJadwal'
        ));
    }
}
