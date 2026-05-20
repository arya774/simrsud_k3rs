<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\SubUraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class InspeksiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $inspeksis = Inspeksi::with('ruangan')
            ->latest()
            ->get();

        $ruangan = Ruangan::all();

        $kategoris = Kategori::with([
            'subUraians.uraian'
        ])->get();

        return view('inspeksi.index', compact(
            'inspeksis',
            'ruangan',
            'kategoris'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT
    |--------------------------------------------------------------------------
    */
    public function riwayat()
    {
        $inspeksis = Inspeksi::with('ruangan')
            ->latest()
            ->get();

        return view('inspeksi.riwayat', compact('inspeksis'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $ruangan = Ruangan::all();

        $kategoris = Kategori::with([
            'subUraians.uraian'
        ])->get();

        return view('inspeksi.create', compact(
            'ruangan',
            'kategoris'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $data = $this->validateData($request);

            [
                $jawaban,
                $hasil,
                $status,
                $badge,
                $baik,
                $buruk,
                $total
            ] = $this->prosesJawaban($request);

            /*
            |--------------------------------------------------------------------------
            | CATATAN PER KATEGORI
            |--------------------------------------------------------------------------
            */
            $catatanKategori = $request->catatan_kategori ?? [];

            Inspeksi::create([

                // DATA
                ...$data,

                // PETUGAS
                'nama_petugas_k3rs'    => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan' => $request->nama_petugas_ruangan,

                // TTD
                'ttd_k3rs'    => $request->ttd_k3rs,
                'ttd_ruangan' => $request->ttd_ruangan,

                // KETERANGAN UMUM
                'keterangan' => $request->keterangan,

                // CATATAN PER KATEGORI
                'catatan_kategori' => $catatanKategori,

                // JAWABAN
                'jawaban' => $jawaban,

                // HASIL
                'hasil'  => $hasil,
                'status' => $status,
                'badge'  => $badge,

                // STATISTIK
                'jumlah_baik'  => $baik,
                'jumlah_buruk' => $buruk,
                'total_soal'   => $total,
            ]);

            DB::commit();

            return redirect()
                ->route('inspeksi.riwayat')
                ->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('STORE INSPEKSI ERROR', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Gagal simpan data : ' . $e->getMessage()
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $inspeksi = Inspeksi::with('ruangan')
            ->findOrFail($id);

        $subUraian = SubUraian::with([
            'uraian.kategori'
        ])->get();

        return view('inspeksi.hasil', [
            'inspeksi'         => $inspeksi,
            'jawaban'          => $inspeksi->jawaban ?? [],
            'subUraian'        => $subUraian,
            'catatanKategori'  => $inspeksi->catatan_kategori ?? [],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $inspeksi = Inspeksi::findOrFail($id);

        $subUraian = SubUraian::with([
            'uraian.kategori'
        ])->get();

        $ruangan = Ruangan::all();

        $kategoris = Kategori::with([
            'subUraians.uraian'
        ])->get();

        return view('inspeksi.edit', compact(
            'inspeksi',
            'subUraian',
            'ruangan',
            'kategoris'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $data = $this->validateData($request);

            $inspeksi = Inspeksi::findOrFail($id);

            [
                $jawaban,
                $hasil,
                $status,
                $badge,
                $baik,
                $buruk,
                $total
            ] = $this->prosesJawaban($request);

            /*
            |--------------------------------------------------------------------------
            | CATATAN PER KATEGORI
            |--------------------------------------------------------------------------
            */
            $catatanKategori = $request->catatan_kategori ?? [];

            $inspeksi->update([

                // DATA
                ...$data,

                // PETUGAS
                'nama_petugas_k3rs'    => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan' => $request->nama_petugas_ruangan,

                // TTD
                'ttd_k3rs'    => $request->ttd_k3rs,
                'ttd_ruangan' => $request->ttd_ruangan,

                // KETERANGAN
                'keterangan' => $request->keterangan,

                // CATATAN PER KATEGORI
                'catatan_kategori' => $catatanKategori,

                // JAWABAN
                'jawaban' => $jawaban,

                // HASIL
                'hasil'  => $hasil,
                'status' => $status,
                'badge'  => $badge,

                // STATISTIK
                'jumlah_baik'  => $baik,
                'jumlah_buruk' => $buruk,
                'total_soal'   => $total,
            ]);

            DB::commit();

            return redirect()
                ->route('inspeksi.riwayat')
                ->with('success', 'Data inspeksi berhasil diupdate');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('UPDATE INSPEKSI ERROR', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Gagal update data : ' . $e->getMessage()
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {

            $inspeksi = Inspeksi::findOrFail($id);

            $inspeksi->delete();

            return back()->with(
                'success',
                'Data inspeksi berhasil dihapus'
            );

        } catch (\Throwable $e) {

            Log::error('DELETE INSPEKSI ERROR', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CETAK PDF
    |--------------------------------------------------------------------------
    */
    public function cetakPdf($id)
    {
        $inspeksi = Inspeksi::with('ruangan')
            ->findOrFail($id);

        $subUraian = SubUraian::with([
            'uraian.kategori'
        ])->get();

        $pdf = Pdf::loadView('inspeksi.pdf', [
            'inspeksi'        => $inspeksi,
            'jawaban'         => $inspeksi->jawaban ?? [],
            'subUraian'       => $subUraian,
            'catatanKategori' => $inspeksi->catatan_kategori ?? [],
        ]);

        return $pdf->download('laporan-inspeksi.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI
    |--------------------------------------------------------------------------
    */
    private function validateData(Request $request)
    {
        return $request->validate([

            'tanggal' => [
                'required',
                'date'
            ],

            'ruangan_id' => [
                'required',
                'exists:ruangans,id'
            ],

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES JAWABAN
    |--------------------------------------------------------------------------
    */
    private function prosesJawaban(Request $request)
    {
        $subUraianIds = SubUraian::pluck('id')->toArray();

        $input = $request->input('jawaban', []);

        $jawaban = [];

        foreach ($subUraianIds as $id) {

            $value = $input[$id] ?? 'Tidak';

            $value = strtolower(trim($value));

            if (
                $value === 'baik' ||
                $value === 'ya' ||
                $value === 'yes' ||
                $value === '1'
            ) {

                $jawaban[$id] = 'Baik';

            } else {

                $jawaban[$id] = 'Tidak';
            }
        }

        $total = count($jawaban);

        $baik = collect($jawaban)
            ->filter(function ($item) {
                return $item === 'Baik';
            })
            ->count();

        $buruk = $total - $baik;

        $hasil = $total > 0
            ? round(($baik / $total) * 100)
            : 0;

        if ($hasil >= 85) {

            $status = 'Sangat Baik';
            $badge  = 'success';

        } elseif ($hasil >= 70) {

            $status = 'Baik';
            $badge  = 'primary';

        } elseif ($hasil >= 50) {

            $status = 'Cukup';
            $badge  = 'warning';

        } else {

            $status = 'Buruk';
            $badge  = 'danger';
        }

        return [
            $jawaban,
            $hasil,
            $status,
            $badge,
            $baik,
            $buruk,
            $total
        ];
    }
}