<?php

namespace App\Http\Controllers;

use App\Models\SubUraian;
use App\Models\Uraian;
use Illuminate\Http\Request;

class SubUraianController extends Controller
{
    public function index()
    {
        $data = SubUraian::with('uraian.kategori')
                    ->latest()
                    ->get();

        return view('sub-uraian.index', compact('data'));
    }

    public function create()
    {
        $uraian = Uraian::with('kategori')
                    ->latest()
                    ->get();

        return view('sub-uraian.create', compact('uraian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian_id'       => 'required|exists:uraians,id',
            'nama_sub_uraian' => 'required|max:255',
        ], [
            'uraian_id.required'       => 'Uraian wajib dipilih',
            'uraian_id.exists'         => 'Uraian tidak ditemukan',
            'nama_sub_uraian.required' => 'Nama sub uraian wajib diisi',
            'nama_sub_uraian.max'      => 'Nama sub uraian maksimal 255 karakter',
        ]);

        SubUraian::create($request->all());

        return redirect()
            ->route('master-data.sub-uraian.index')
            ->with('success', 'Sub uraian berhasil ditambahkan');
    }

    public function show(SubUraian $subUraian)
    {
        return view('sub-uraian.show', compact('subUraian'));
    }

    public function edit(SubUraian $subUraian)
    {
        $uraian = Uraian::with('kategori')
                    ->latest()
                    ->get();

        return view('sub-uraian.edit', compact('subUraian', 'uraian'));
    }

    public function update(Request $request, SubUraian $subUraian)
    {
        $request->validate([
            'uraian_id'       => 'required|exists:uraians,id',
            'nama_sub_uraian' => 'required|max:255',
        ]);

        $subUraian->update([
            'uraian_id'       => $request->uraian_id,
            'nama_sub_uraian' => $request->nama_sub_uraian,
        ]);

        return redirect()
            ->route('master-data.sub-uraian.index')
            ->with('success', 'Sub uraian berhasil diupdate');
    }

    public function destroy(SubUraian $subUraian)
    {
        $subUraian->delete();

        return redirect()
            ->route('master-data.sub-uraian.index')
            ->with('success', 'Sub uraian berhasil dihapus');
    }
}