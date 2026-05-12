<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;

class RiwayatInspeksiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RIWAYAT INSPEKSI
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $riwayat = Inspeksi::with('ruangan')
            ->latest()
            ->get();

        return view('inspeksi.riwayat', [
            'riwayat' => $riwayat
        ]);
    }
}