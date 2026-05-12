<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspeksi;
use App\Models\Ruangan;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanInspeksiController extends Controller
{
    /**
     * Menampilkan halaman laporan inspeksi
     */
    public function index(Request $request)
    {
        $inspeksi = $this->filterData($request);

        return view('laporan.inspeksi', [
            'inspeksi' => $inspeksi,
            'ruangan'  => Ruangan::all(),
            'kategori' => Kategori::all(),
            'request'  => $request
        ]);
    }

    /**
     * Export PDF laporan inspeksi
     */
    public function pdf(Request $request)
    {
        $inspeksi = $this->filterData($request);

        $pdf = Pdf::loadView('laporan.pdf', [
            'inspeksi' => $inspeksi,
            'request'  => $request
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-inspeksi.pdf');
    }

    /**
     * Filter data inspeksi
     */
    private function filterData(Request $request)
    {
        $query = Inspeksi::with(['ruangan', 'kategori']);

        // Filter tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [
                $request->dari,
                $request->sampai
            ]);
        }

        // Filter ruangan
        if ($request->filled('ruangan_id')) {
            $query->where('ruangan_id', $request->ruangan_id);
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        return $query->latest()->get();
    }
}