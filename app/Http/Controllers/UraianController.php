<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use App\Models\Kategori;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    public function index()
    {
        $data = Uraian::with('kategori')
                    ->latest()
                    ->get();

        return view('uraian.index', compact('data'));
    }

    public function create()
    {
        $kategori = Kategori::latest()->get();

        return view('uraian.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_uraian' => 'required|string|max:255',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists'   => 'Kategori tidak ditemukan',
            'nama_uraian.required' => 'Nama uraian wajib diisi',
            'nama_uraian.max'      => 'Nama uraian maksimal 255 karakter',
        ]);

        Uraian::create([
            'kategori_id' => $request->kategori_id,
            'nama_uraian' => $request->nama_uraian,
        ]);

        return redirect()
            ->route('master-data.uraian.index')
            ->with('success', 'Data uraian berhasil ditambahkan');
    }

    public function show(Uraian $uraian)
    {
        return view('uraian.show', compact('uraian'));
    }

    public function edit(Uraian $uraian)
    {
        $kategori = Kategori::latest()->get();

        return view('uraian.edit', compact('uraian', 'kategori'));
    }

    public function update(Request $request, Uraian $uraian)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_uraian' => 'required|string|max:255',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists'   => 'Kategori tidak ditemukan',
            'nama_uraian.required' => 'Nama uraian wajib diisi',
            'nama_uraian.max'      => 'Nama uraian maksimal 255 karakter',
        ]);

        $uraian->update([
            'kategori_id' => $request->kategori_id,
            'nama_uraian' => $request->nama_uraian,
        ]);

        return redirect()
            ->route('master-data.uraian.index')
            ->with('success', 'Data uraian berhasil diupdate');
    }

    public function destroy(Uraian $uraian)
    {
        $uraian->delete();

        return redirect()
            ->route('master-data.uraian.index')
            ->with('success', 'Data uraian berhasil dihapus');
    }
}