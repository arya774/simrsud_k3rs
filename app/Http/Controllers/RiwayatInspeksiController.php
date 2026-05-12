<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;

class RiwayatInspeksiController extends Controller
{
    public function index()
    {
        $inspeksi = Inspeksi::latest()->get();

        return view('inspeksi.riwayat', compact('inspeksi'));
    }
}