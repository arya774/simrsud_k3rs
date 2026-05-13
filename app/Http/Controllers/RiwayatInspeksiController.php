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
        $inspeksis = Inspeksi::with(['ruangan', 'kategori'])
            ->latest()
            ->get();

        return view('inspeksi.riwayat', compact('inspeksis'));
    }
}