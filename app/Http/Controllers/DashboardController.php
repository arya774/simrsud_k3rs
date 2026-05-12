<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspeksi;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\SubUraian;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | TOTAL DATA CARD
        |--------------------------------------------------------------------------
        */
        $totalInspeksi = Inspeksi::count();
        $totalRuangan = Ruangan::count();
        $totalKategori = Kategori::count();
        $totalSubUraian = SubUraian::count();

        /*
        |--------------------------------------------------------------------------
        | DATA INSPEKSI TERBARU
        |--------------------------------------------------------------------------
        */
        $inspeksi = Inspeksi::with('ruangan')
            ->latest()
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | GRAFIK STATUS JAWABAN
        |--------------------------------------------------------------------------
        */
        $totalBaik = 0;
        $totalTidakBaik = 0;

        foreach ($inspeksi as $item) {

            // ❗ SUDAH ARRAY (karena cast di model)
            $jawaban = $item->jawaban ?? [];

            if (is_array($jawaban)) {

                foreach ($jawaban as $value) {

                    if ($value === 'Baik') {
                        $totalBaik++;
                    } else {
                        $totalTidakBaik++;
                    }
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view('dashboard', compact(
            'totalInspeksi',
            'totalRuangan',
            'totalKategori',
            'totalSubUraian',
            'totalBaik',
            'totalTidakBaik',
            'inspeksi'
        ));
    }
}