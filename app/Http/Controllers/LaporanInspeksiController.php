<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspeksi;
use App\Models\Ruangan;
use App\Models\Kategori;

class LaporanInspeksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Inspeksi::with(['ruangan', 'kategori']);

        // FILTER TANGGAL
        if ($request->dari && $request->sampai) {
            $query->whereBetween('tanggal', [
                $request->dari,
                $request->sampai
            ]);
        }

        // FILTER RUANGAN
        if ($request->ruangan_id) {
            $query->where('ruangan_id', $request->ruangan_id);
        }

        // FILTER KATEGORI
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $inspeksi = $query->latest()->get();

        $ruangan = Ruangan::all();
        $kategori = Kategori::all();

        return view('laporan.inspeksi', compact(
            'inspeksi',
            'ruangan',
            'kategori'
        ));
    }
}