<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspeksi;
use App\Models\Ruangan;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
     * Export PDF laporan inspeksi (🔥 UPGRADE DISINI)
     */
    public function pdf(Request $request)
    {
        $inspeksi = $this->filterData($request);

        $pdf = Pdf::loadView('laporan.pdf', [
            'inspeksi' => $inspeksi,
            'request'  => $request
        ]);

        $pdf->setPaper('A4', 'landscape');

        /*
        |--------------------------------------------------------------------------
        | 🔥 GENERATE NAMA FILE DINAMIS
        |--------------------------------------------------------------------------
        */

        // 📅 Format tanggal
        $dari   = $request->dari 
            ? Carbon::parse($request->dari)->format('Y-m-d') 
            : null;

        $sampai = $request->sampai 
            ? Carbon::parse($request->sampai)->format('Y-m-d') 
            : null;

        // 🏥 Ambil nama ruangan
        $namaRuangan = null;

        if ($request->ruangan_id) {
            $ruangan = Ruangan::find($request->ruangan_id);

            $namaRuangan = $ruangan->nama_ruangan 
                ?? $ruangan->nama 
                ?? 'semua-ruangan';
        }

        // 🔥 FORMAT FINAL
        $ruanganText = $namaRuangan 
            ? strtoupper(Str::slug($namaRuangan, '-')) 
            : 'SEMUA-RUANGAN';

        // 📄 Susun nama file
        if ($dari && $sampai) {
            $fileName = "Laporan-Inspeksi-{$ruanganText}-{$dari}_sampai_{$sampai}.pdf";
        } elseif ($dari) {
            $fileName = "Laporan-Inspeksi-{$ruanganText}-{$dari}.pdf";
        } else {
            $fileName = "Laporan-Inspeksi-{$ruanganText}.pdf";
        }

        return $pdf->download($fileName);
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