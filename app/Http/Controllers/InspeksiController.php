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
        return view('inspeksi.index', [
            'kategori' => Kategori::orderBy('id')->get(),
            'uraian' => Uraian::orderBy('id')->get(),
            'subUraian' => SubUraian::with('uraian')->orderBy('id')->get(),
            'ruangan' => Ruangan::orderBy('nama_ruangan')->get(),
        ]);
    }

    public function create()
    {
        return $this->index();
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (FIX TOTAL AMAN + REDIRECT STABIL)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruangan_id' => 'required',
            'keterangan' => 'nullable',
            'nama_petugas_k3rs' => 'nullable|string|max:255',
            'nama_petugas_ruangan' => 'nullable|string|max:255',
            'ttd_k3rs' => 'nullable',
            'ttd_ruangan' => 'nullable',
            'jawaban' => 'nullable|array',
        ]);

        try {

            DB::beginTransaction();

            $inspeksi = new Inspeksi();
            $inspeksi->tanggal = $request->tanggal;
            $inspeksi->ruangan_id = $request->ruangan_id;
            $inspeksi->keterangan = $request->keterangan;
            $inspeksi->nama_petugas_k3rs = $request->nama_petugas_k3rs;
            $inspeksi->nama_petugas_ruangan = $request->nama_petugas_ruangan;
            $inspeksi->ttd_k3rs = $request->ttd_k3rs;
            $inspeksi->ttd_ruangan = $request->ttd_ruangan;

            // FIX: selalu array aman
            $inspeksi->jawaban = json_encode($request->jawaban ?? [], JSON_UNESCAPED_UNICODE);

            $inspeksi->save();

            DB::commit();

            /*
            | FIX PENTING:
            | pakai ID saja (lebih aman dari binding error)
            */
            return redirect('/inspeksi/' . $inspeksi->id . '/hasil');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HASIL INSPEKSI (ANTI BLANK + ANTI ERROR)
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $inspeksi = Inspeksi::with('ruangan')->find($id);

        if (!$inspeksi) {
            abort(404, 'Data inspeksi tidak ditemukan');
        }

        $jawaban = json_decode($inspeksi->jawaban, true) ?? [];

        $subUraian = SubUraian::with('uraian')->get();

        return view('inspeksi.hasil', [
            'inspeksi' => $inspeksi,
            'jawaban' => $jawaban,
            'subUraian' => $subUraian,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Inspeksi $inspeksi)
    {
        return view('inspeksi.edit', [
            'inspeksi' => $inspeksi,
            'kategori' => Kategori::all(),
            'uraian' => Uraian::all(),
            'subUraian' => SubUraian::all(),
            'ruangan' => Ruangan::all(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (FIX REDIRECT + SAFE JSON)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Inspeksi $inspeksi)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'ruangan_id' => 'required',
        ]);

        $inspeksi->update([
            'tanggal' => $request->tanggal,
            'ruangan_id' => $request->ruangan_id,
            'keterangan' => $request->keterangan,
            'nama_petugas_k3rs' => $request->nama_petugas_k3rs,
            'nama_petugas_ruangan' => $request->nama_petugas_ruangan,
            'ttd_k3rs' => $request->ttd_k3rs,
            'ttd_ruangan' => $request->ttd_ruangan,
            'jawaban' => json_encode($request->jawaban ?? [], JSON_UNESCAPED_UNICODE),
        ]);

        return redirect()->route('inspeksi.hasil', ['inspeksi' => $inspeksi->id]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(Inspeksi $inspeksi)
    {
        $inspeksi->delete();

        return redirect()->route('inspeksi.index')
            ->with('success', 'Data inspeksi berhasil dihapus');
    }
}