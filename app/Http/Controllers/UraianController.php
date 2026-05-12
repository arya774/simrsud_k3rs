<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use App\Models\Kategori;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Uraian::with('kategori')
                    ->latest()
                    ->get();

        return view('uraian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::latest()->get();

        return view('uraian.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'kategori_id' => 'required|exists:kategoris,id',
            'nama_uraian' => 'required|string|max:255',

        ]);

        Uraian::create([

            'kategori_id' => $request->kategori_id,
            'nama_uraian' => $request->nama_uraian,

        ]);

        return redirect()
                ->route('master-data.uraian.index')
                ->with('success', 'Data uraian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Uraian  $uraian
     * @return \Illuminate\Http\Response
     */
    public function show(Uraian $uraian)
    {
        return view('uraian.show', compact('uraian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Uraian  $uraian
     * @return \Illuminate\Http\Response
     */
    public function edit(Uraian $uraian)
    {
        $kategori = Kategori::latest()->get();

        return view('uraian.edit', compact('uraian', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Uraian  $uraian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Uraian $uraian)
    {
        $request->validate([

            'kategori_id' => 'required|exists:kategoris,id',
            'nama_uraian' => 'required|string|max:255',

        ]);

        $uraian->update([

            'kategori_id' => $request->kategori_id,
            'nama_uraian' => $request->nama_uraian,

        ]);

        return redirect()
                ->route('master-data.uraian.index')
                ->with('success', 'Data uraian berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Uraian  $uraian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Uraian $uraian)
    {
        $uraian->delete();

        return redirect()
                ->route('master-data.uraian.index')
                ->with('success', 'Data uraian berhasil dihapus');
    }
}