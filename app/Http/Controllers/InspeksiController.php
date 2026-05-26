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
use Carbon\Carbon;

class InspeksiController extends Controller
{
    public function index()
    {
        return view('inspeksi.index', [
            'inspeksis' => Inspeksi::with('ruangan')->latest()->get(),
            'ruangan'   => Ruangan::all(),
            'kategoris' => Kategori::with('subUraians.uraian')->get(),
        ]);
    }

    public function riwayat()
    {
        return view('inspeksi.riwayat', [
            'inspeksis' => Inspeksi::with('ruangan')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('inspeksi.create', [
            'ruangan'   => Ruangan::all(),
            'kategoris' => Kategori::with('subUraians.uraian')->get(),
        ]);
    }

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

            Inspeksi::create([
                ...$data,

                'nama_petugas_k3rs'     => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan' => $request->nama_petugas_ruangan,

                'ttd_k3rs'    => $request->ttd_k3rs,
                'ttd_ruangan' => $request->ttd_ruangan,

                'keterangan'        => $request->keterangan,
                'catatan_kategori' => $request->catatan_kategori ?? [],

                'jawaban' => $jawaban,

                'hasil'  => $hasil,
                'status' => $status,
                'badge'  => $badge,

                'jumlah_baik'  => $baik,
                'jumlah_buruk' => $buruk,
                'total_soal'   => $total,
            ]);

            DB::commit();

            return redirect()->route('inspeksi.riwayat')
                ->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('STORE ERROR', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Gagal simpan data : ' . $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $inspeksi = Inspeksi::with('ruangan')->findOrFail($id);

        return view('inspeksi.hasil', [
            'inspeksi'        => $inspeksi,
            'jawaban'         => $inspeksi->jawaban ?? [],
            'subUraian'       => SubUraian::with('uraian.kategori')->get(),
            'catatanKategori' => $inspeksi->catatan_kategori ?? [],
        ]);
    }

    public function edit($id)
    {
        return view('inspeksi.edit', [
            'inspeksi'  => Inspeksi::findOrFail($id),
            'subUraian' => SubUraian::with('uraian.kategori')->get(),
            'ruangan'   => Ruangan::all(),
            'kategoris' => Kategori::with('subUraians.uraian')->get(),
        ]);
    }

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

            $inspeksi->update([
                ...$data,

                'nama_petugas_k3rs'     => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan' => $request->nama_petugas_ruangan,

                'ttd_k3rs'    => $request->ttd_k3rs,
                'ttd_ruangan' => $request->ttd_ruangan,

                'keterangan'        => $request->keterangan,
                'catatan_kategori' => $request->catatan_kategori ?? [],

                'jawaban' => $jawaban,

                'hasil'  => $hasil,
                'status' => $status,
                'badge'  => $badge,

                'jumlah_baik'  => $baik,
                'jumlah_buruk' => $buruk,
                'total_soal'   => $total,
            ]);

            DB::commit();

            return redirect()->route('inspeksi.riwayat')
                ->with('success', 'Data inspeksi berhasil diupdate');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('UPDATE ERROR', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()->withInput()->withErrors([
                'error' => 'Gagal update data : ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {

            Inspeksi::findOrFail($id)->delete();

            return back()->with('success', 'Data inspeksi berhasil dihapus');

        } catch (\Throwable $e) {

            Log::error('DELETE ERROR', [
                'message' => $e->getMessage(),
            ]);

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function cetakPdf($id)
    {
        $inspeksi = Inspeksi::with('ruangan')->findOrFail($id);

        $pdf = Pdf::loadView('inspeksi.pdf', [
            'inspeksi'        => $inspeksi,
            'jawaban'         => $inspeksi->jawaban ?? [],
            'subUraian'       => SubUraian::with('uraian.kategori')->get(),
            'catatanKategori' => $inspeksi->catatan_kategori ?? [],
        ]);

        $namaRuangan = $inspeksi->ruangan->nama_ruangan 
            ?? $inspeksi->ruangan->nama 
            ?? 'ruangan';

        $ruangan = strtoupper($namaRuangan);
        $tanggal = Carbon::parse($inspeksi->tanggal)->format('Y-m-d');

        $fileName = "Laporan-Inspeksi-{$ruangan}-{$tanggal}.pdf";

        return $pdf->download($fileName);
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'tanggal'    => ['required', 'date'],
            'ruangan_id' => ['required', 'exists:ruangans,id'],
        ]);
    }

    /*
    🔥 FINAL FIX ALL LOGIC DISINI
    */
    private function prosesJawaban(Request $request)
    {
        $subUraianIds = SubUraian::pluck('id')->toArray();
        $input = $request->input('jawaban', []);

        $jawaban = [];

        foreach ($subUraianIds as $id) {

            $value = strtolower(trim($input[$id] ?? ''));

            if (in_array($value, ['baik', 'ya', 'yes', '1'])) {
                $jawaban[$id] = 'Baik';
            } else {
                $jawaban[$id] = 'Tidak';
            }
        }

        $total = count($jawaban);

        // 🔥 FIX PERHITUNGAN
        $baik = collect($jawaban)->filter(fn($v) => $v === 'Baik')->count();

        $buruk = $total - $baik;

        $hasil = $total > 0 ? round(($baik / $total) * 100, 2) : 0;

        // 🔥 STATUS LEBIH RAPI
        $status = match (true) {
            $hasil >= 85 => 'Sangat Baik',
            $hasil >= 70 => 'Baik',
            $hasil >= 50 => 'Cukup',
            default      => 'Buruk',
        };

        $badge = match ($status) {
            'Sangat Baik' => 'success',
            'Baik'        => 'primary',
            'Cukup'       => 'warning',
            default       => 'danger',
        };

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