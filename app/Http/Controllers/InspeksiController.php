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
            'inspeksis' => Inspeksi::with(['ruangan', 'kategori'])
                ->latest()
                ->get(),
        ]);
    }

    public function riwayat()
    {
        return view('inspeksi.riwayat', [
            'inspeksis' => Inspeksi::with(['ruangan', 'kategori'])
                ->latest()
                ->get()
        ]);
    }

    public function create()
    {
        return $this->index();
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

            $validated = $request->validate([
                'tanggal'      => 'required|date',
                'ruangan_id'   => 'required|exists:ruangans,id',
                'kategori_id'  => 'required|exists:kategoris,id',
                'jawaban'      => 'nullable|array',
            ]);

            /*
            |--------------------------------------------------------------------------
            | AMBIL SUB URAIAN SESUAI KATEGORI
            |--------------------------------------------------------------------------
            */

            $subUraianKategori = SubUraian::whereHas('uraian', function ($q) use ($validated) {

                $q->where('kategori_id', $validated['kategori_id']);

            })->pluck('id')->toArray();

            $jawabanInput = $request->input('jawaban', []);

            $jawaban = [];

            /*
            |--------------------------------------------------------------------------
            | JIKA TIDAK DIISI -> OTOMATIS BAIK
            |--------------------------------------------------------------------------
            */

            foreach ($subUraianKategori as $id) {

                $jawaban[$id] = $jawabanInput[$id] ?? 'Baik';

            }

            /*
            |--------------------------------------------------------------------------
            | HITUNG HASIL
            |--------------------------------------------------------------------------
            */

            $total = count($jawaban);

            $baik = 0;

            foreach ($jawaban as $value) {

                if ($value === 'Baik') {

                    $baik++;

                }

            }

            $hasil = $total > 0
                ? round(($baik / $total) * 100)
                : 0;

            /*
            |--------------------------------------------------------------------------
            | STATUS HASIL
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | SIMPAN
            |--------------------------------------------------------------------------
            */

            Inspeksi::create([
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
                'status'               => $status,
                'badge'                => $badge,
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
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
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

            /*
            |--------------------------------------------------------------------------
            | AMBIL SUB URAIAN SESUAI KATEGORI
            |--------------------------------------------------------------------------
            */

            $subUraianKategori = SubUraian::whereHas('uraian', function ($q) use ($validated) {

                $q->where('kategori_id', $validated['kategori_id']);

            })->pluck('id')->toArray();

            $jawabanInput = $request->input('jawaban', []);

            $jawaban = [];

            /*
            |--------------------------------------------------------------------------
            | JIKA TIDAK DIISI -> OTOMATIS BAIK
            |--------------------------------------------------------------------------
            */

            foreach ($subUraianKategori as $idSub) {

                $jawaban[$idSub] = $jawabanInput[$idSub] ?? 'Baik';

            }

            /*
            |--------------------------------------------------------------------------
            | HITUNG HASIL
            |--------------------------------------------------------------------------
            */

            $total = count($jawaban);

            $baik = 0;

            foreach ($jawaban as $value) {

                if ($value === 'Baik') {

                    $baik++;

                }

            }

            $hasil = $total > 0
                ? round(($baik / $total) * 100)
                : 0;

            /*
            |--------------------------------------------------------------------------
            | STATUS HASIL
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

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
                'status'               => $status,
                'badge'                => $badge,
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

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $inspeksi = Inspeksi::with(['ruangan', 'kategori'])
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | HANYA TAMPILKAN SUB URAIAN SESUAI KATEGORI
        |--------------------------------------------------------------------------
        */

        $subUraian = SubUraian::with('uraian')
            ->whereHas('uraian', function ($q) use ($inspeksi) {

                $q->where('kategori_id', $inspeksi->kategori_id);

            })
            ->get();

        return view('inspeksi.hasil', [
            'inspeksi'  => $inspeksi,
            'jawaban'   => $inspeksi->jawaban ?? [],
            'subUraian' => $subUraian,
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

        /*
        |--------------------------------------------------------------------------
        | FILTER SUB URAIAN SESUAI KATEGORI
        |--------------------------------------------------------------------------
        */

        $subUraian = SubUraian::with('uraian')
            ->whereHas('uraian', function ($q) use ($inspeksi) {

                $q->where('kategori_id', $inspeksi->kategori_id);

            })
            ->get();

        return view('inspeksi.edit', [
            'inspeksi'  => $inspeksi,
            'kategori'  => Kategori::all(),
            'uraian'    => Uraian::all(),
            'subUraian' => $subUraian,
            'ruangan'   => Ruangan::all(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

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