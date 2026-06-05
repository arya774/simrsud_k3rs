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
        return view('inspeksi.index', $this->getFormData() + [
            'inspeksis' => Inspeksi::with('ruangan')->latest()->get(),
        ]);
    }

    public function riwayat()
    {
        $inspeksis = Inspeksi::with('ruangan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('inspeksi.riwayat', compact('inspeksis'));
    }

    public function create()
    {
        return view('inspeksi.create', $this->getFormData());
    }

    public function store(Request $request)
    {
        return $this->handleTransaction(function () use ($request) {

            $validated = $request->validate([
                'tanggal'    => ['required', 'date'],
                'ruangan_id' => ['required', 'exists:ruangans,id'],
            ]);

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
                'tanggal' => $validated['tanggal'],
                'ruangan_id' => $validated['ruangan_id'],

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

            return redirect()->route('inspeksi.riwayat')
                ->with('success', 'Inspeksi berhasil disimpan');
        });
    }

    public function show($id)
    {
        $inspeksi = Inspeksi::with('ruangan')->findOrFail($id);

        return view('inspeksi.hasil', $this->getDetailData($inspeksi));
    }

    public function edit($id)
    {
        $inspeksi = Inspeksi::findOrFail($id);

        return view('inspeksi.edit', $this->getFormData() + [
            'inspeksi' => $inspeksi,
            'subUraian' => $this->getSubUraian()
        ]);
    }

    public function update(Request $request, $id)
    {
        return $this->handleTransaction(function () use ($request, $id) {

            $inspeksi = Inspeksi::findOrFail($id);

            $validated = $request->validate([
                'ruangan_id' => ['required', 'exists:ruangans,id'],
            ]);

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
                'tanggal' => $inspeksi->tanggal,

                'ruangan_id' => $validated['ruangan_id'],

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

            return redirect()->route('inspeksi.riwayat')
                ->with('success', 'Data berhasil diupdate');
        });
    }

    public function destroy($id)
    {
        try {
            Inspeksi::findOrFail($id)->delete();

            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $e) {
            Log::error('DELETE ERROR', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function cetakPdf($id)
    {
        $inspeksi = Inspeksi::with('ruangan')->findOrFail($id);

        $pdf = Pdf::loadView('inspeksi.pdf', $this->getDetailData($inspeksi));

        $ruangan = strtoupper(
            $inspeksi->ruangan->nama_ruangan
            ?? $inspeksi->ruangan->nama
            ?? 'ruangan'
        );

        $tanggal = Carbon::parse($inspeksi->tanggal)->format('Y-m-d');

        return $pdf->download("Laporan-Inspeksi-{$ruangan}-{$tanggal}.pdf");
    }

    private function handleTransaction($callback)
    {
        DB::beginTransaction();

        try {
            $result = $callback();
            DB::commit();
            return $result;

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('ERROR', [
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return back()->withInput()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }

    private function getFormData()
    {
        return [
            'ruangan'   => Ruangan::all(),
            'kategoris' => Kategori::with('subUraians.uraian')->get(),
        ];
    }

    private function getSubUraian()
    {
        return SubUraian::with('uraian.kategori')->get();
    }

    private function getDetailData($inspeksi)
    {
        return [
            'inspeksi'        => $inspeksi,
            'jawaban'         => $inspeksi->jawaban ?? [],
            'subUraian'       => $this->getSubUraian(),
            'catatanKategori' => $inspeksi->catatan_kategori ?? [],
        ];
    }

    /**
     * 🔥 FIX TOTAL DI SINI
     */
    private function prosesJawaban(Request $request)
    {
        $subUraianIds = SubUraian::pluck('id');
        $input = $request->input('jawaban', []);

        $jawaban = $subUraianIds->mapWithKeys(function ($id) use ($input) {

            $value = strtolower(trim($input[$id] ?? ''));

            return [
                $id => in_array($value, ['baik', 'ya', 'yes', '1'])
                    ? 'Baik'
                    : 'Tidak Baik'
            ];
        });

        $total = $jawaban->count();

        $baik = $jawaban->filter(function ($j) {
            return $j === 'Baik';
        })->count();

        $buruk = $jawaban->filter(function ($j) {
            return $j === 'Tidak Baik';
        })->count();

        $hasil = $total > 0 ? round(($baik / $total) * 100, 2) : 0;

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