<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use App\Models\Kategori;
use App\Models\Ruangan;
use App\Models\SubUraian;
use App\Models\Uraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspeksiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM INSPEKSI
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $inspeksis = Inspeksi::with([
            'ruangan',
            'kategori'
        ])
        ->latest()
        ->get();

        return view('inspeksi.index', [
            'kategori'   => Kategori::orderBy('id')->get(),
            'uraian'     => Uraian::orderBy('id')->get(),
            'subUraian'  => SubUraian::with('uraian')->orderBy('id')->get(),
            'ruangan'    => Ruangan::orderBy('nama_ruangan')->get(),
            'inspeksis'  => $inspeksis,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT INSPEKSI
    |--------------------------------------------------------------------------
    */
    public function riwayat()
    {
        $inspeksis = Inspeksi::with([
            'ruangan',
            'kategori'
        ])
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
        return $this->index();
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'               => 'required|date',
            'ruangan_id'            => 'required|exists:ruangans,id',
            'kategori_id'           => 'required|exists:kategoris,id',
            'jawaban'               => 'required|array',
            'nama_petugas_k3rs'     => 'nullable|string|max:255',
            'nama_petugas_ruangan'  => 'nullable|string|max:255',
            'keterangan'            => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $jawaban = $request->jawaban ?? [];

            $totalChecklist = count($jawaban);

            $jumlahBaik = collect($jawaban)
                ->filter(function ($value) {
                    return $value === 'Baik';
                })
                ->count();

            $hasil = $totalChecklist > 0
                ? round(($jumlahBaik / $totalChecklist) * 100)
                : 0;

            $inspeksi = Inspeksi::create([
                'tanggal'               => $request->tanggal,
                'ruangan_id'            => $request->ruangan_id,
                'kategori_id'           => $request->kategori_id,
                'keterangan'            => $request->keterangan,
                'nama_petugas_k3rs'     => $request->nama_petugas_k3rs,
                'nama_petugas_ruangan'  => $request->nama_petugas_ruangan,
                'ttd_k3rs'              => $request->ttd_k3rs,
                'ttd_ruangan'           => $request->ttd_ruangan,
                'jawaban'               => $jawaban,
                'hasil'                 => $hasil,
            ]);

            DB::commit();

            return redirect()
                ->route('inspeksi.riwayat')
                ->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL HASIL
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $inspeksi = Inspeksi::with([
            'ruangan',
            'kategori'
        ])->findOrFail($id);

        return view('inspeksi.hasil', [
            'inspeksi' => $inspeksi,

            'jawaban' => is_array($inspeksi->jawaban)
                ? $inspeksi->jawaban
                : json_decode($inspeksi->jawaban, true),

            'subUraian' => SubUraian::with('uraian')->get(),
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

        return view('inspeksi.edit', [
            'inspeksi'   => $inspeksi,
            'kategori'   => Kategori::all(),
            'uraian'     => Uraian::all(),
            'subUraian'  => SubUraian::with('uraian')->get(),
            'ruangan'    => Ruangan::all(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'ruangan_id'  => 'required|exists:ruangans,id',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $inspeksi = Inspeksi::findOrFail($id);

        $jawaban = $request->jawaban ?? [];

        $totalChecklist = count($jawaban);

        $jumlahBaik = collect($jawaban)
            ->filter(function ($value) {
                return $value === 'Baik';
            })
            ->count();

        $hasil = $totalChecklist > 0
            ? round(($jumlahBaik / $totalChecklist) * 100)
            : 0;

        $inspeksi->update([
            'tanggal'               => $request->tanggal,
            'ruangan_id'            => $request->ruangan_id,
            'kategori_id'           => $request->kategori_id,
            'keterangan'            => $request->keterangan,
            'nama_petugas_k3rs'     => $request->nama_petugas_k3rs,
            'nama_petugas_ruangan'  => $request->nama_petugas_ruangan,
            'ttd_k3rs'              => $request->ttd_k3rs,
            'ttd_ruangan'           => $request->ttd_ruangan,
            'jawaban'               => $jawaban,
            'hasil'                 => $hasil,
        ]);

        return redirect()
            ->route('inspeksi.riwayat')
            ->with('success', 'Data inspeksi berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $inspeksi = Inspeksi::findOrFail($id);

        $inspeksi->delete();

        return redirect()
            ->route('inspeksi.riwayat')
            ->with('success', 'Data inspeksi berhasil dihapus');
    }
}