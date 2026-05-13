<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\SubUraian;
use App\Models\Uraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InspeksiController extends Controller
{
    public function index()
    {
        return view('inspeksi.index', [
            'kategori'  => Kategori::all(),
            'uraian'    => Uraian::all(),
            'subUraian' => SubUraian::with('uraian')->get(),
            'ruangan'   => Ruangan::all(),
            'inspeksis' => Inspeksi::with(['ruangan','kategori'])->latest()->get(),
        ]);
    }

    public function riwayat()
    {
        return view('inspeksi.riwayat', [
            'inspeksis' => Inspeksi::with(['ruangan','kategori'])->latest()->get()
        ]);
    }

    public function create()
    {
        return $this->index();
    }

    /*
    |==========================
    | STORE (FINAL FIX STABLE)
    |==========================
    */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'tanggal'      => 'required|date',
                'ruangan_id'   => 'required|exists:ruangans,id',
                'kategori_id'  => 'required|exists:kategoris,id',
                'jawaban'      => 'nullable|array',
            ]);

            $jawaban = $request->input('jawaban', []);

            // buang kosong
            $jawaban = array_filter($jawaban, function ($v) {
                return $v !== null && $v !== '';
            });

            $total = count($jawaban);

            $baik = 0;
            foreach ($jawaban as $v) {
                if ($v === 'Baik') {
                    $baik++;
                }
            }

            $hasil = $total > 0 ? round(($baik / $total) * 100) : 0;

            $inspeksi = Inspeksi::create([
                'tanggal'              => $validated['tanggal'],
                'ruangan_id'           => $validated['ruangan_id'],
                'kategori_id'          => $validated['kategori_id'],
                'keterangan'           => $request->keterangan,
                'nama_petugas_k3rs'    => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan' => $request->nama_petugas_ruangan,
                'ttd_k3rs'             => $request->ttd_k3rs,
                'ttd_ruangan'          => $request->ttd_ruangan,
                'jawaban'              => $jawaban,
                'hasil'                => $hasil,
            ]);

            DB::commit();

            return redirect()
                ->route('inspeksi.riwayat')
                ->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('STORE INSPEKSI ERROR', [
                'msg' => $e->getMessage()
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Gagal simpan: ' . $e->getMessage()
                ]);
        }
    }

    /*
    |==========================
    | UPDATE (FINAL FIX STABLE)
    |==========================
    */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'tanggal'      => 'required|date',
                'ruangan_id'   => 'required|exists:ruangans,id',
                'kategori_id'  => 'required|exists:kategoris,id',
            ]);

            $inspeksi = Inspeksi::findOrFail($id);

            $jawaban = $request->input('jawaban', []);

            $jawaban = array_filter($jawaban, function ($v) {
                return $v !== null && $v !== '';
            });

            $total = count($jawaban);

            $baik = 0;
            foreach ($jawaban as $v) {
                if ($v === 'Baik') {
                    $baik++;
                }
            }

            $hasil = $total > 0 ? round(($baik / $total) * 100) : 0;

            $inspeksi->update([
                'tanggal'              => $validated['tanggal'],
                'ruangan_id'           => $validated['ruangan_id'],
                'kategori_id'          => $validated['kategori_id'],
                'keterangan'           => $request->keterangan,
                'nama_petugas_k3rs'    => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan' => $request->nama_petugas_ruangan,
                'ttd_k3rs'             => $request->ttd_k3rs,
                'ttd_ruangan'          => $request->ttd_ruangan,
                'jawaban'              => $jawaban,
                'hasil'                => $hasil,
            ]);

            DB::commit();

            return redirect()
                ->route('inspeksi.riwayat')
                ->with('success', 'Data berhasil diupdate');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('UPDATE INSPEKSI ERROR', [
                'msg' => $e->getMessage()
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Gagal update: ' . $e->getMessage()
                ]);
        }
    }

    public function show($id)
    {
        $inspeksi = Inspeksi::with(['ruangan','kategori'])->findOrFail($id);

        return view('inspeksi.hasil', [
            'inspeksi'  => $inspeksi,
            'jawaban'   => $inspeksi->jawaban ?? [],
            'subUraian' => SubUraian::with('uraian')->get(),
        ]);
    }

    public function edit($id)
    {
        return view('inspeksi.edit', [
            'inspeksi'  => Inspeksi::findOrFail($id),
            'kategori'  => Kategori::all(),
            'uraian'    => Uraian::all(),
            'subUraian' => SubUraian::with('uraian')->get(),
            'ruangan'   => Ruangan::all(),
        ]);
    }

    public function destroy($id)
    {
        try {
            Inspeksi::findOrFail($id)->delete();

            return back()->with('success', 'Data berhasil dihapus');

        } catch (\Throwable $e) {

            Log::error('DELETE INSPEKSI ERROR', [
                'msg' => $e->getMessage()
            ]);

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}