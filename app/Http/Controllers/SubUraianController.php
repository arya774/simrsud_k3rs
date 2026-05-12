<?php

namespace App\Http\Controllers;

use App\Models\SubUraian;
use App\Models\Uraian;
use Illuminate\Http\Request;

class SubUraianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubUraian::with('uraian.kategori')
                    ->latest()
                    ->get();

        return view('sub-uraian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uraian = Uraian::with('kategori')
                    ->latest()
                    ->get();

        return view('sub-uraian.create', compact('uraian'));
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

            'uraian_id'       => 'required|exists:uraians,id',
            'nama_sub_uraian' => 'required|max:255',

        ], [

            'uraian_id.required'       => 'Uraian wajib dipilih',
            'uraian_id.exists'         => 'Uraian tidak ditemukan',
            'nama_sub_uraian.required' => 'Nama sub uraian wajib diisi',
            'nama_sub_uraian.max'      => 'Nama sub uraian maksimal 255 karakter',

        ]);

        SubUraian::create([

            'uraian_id'       => $request->uraian_id,
            'nama_sub_uraian' => $request->nama_sub_uraian,

        ]);

        return redirect()
                ->route('master-data.sub-uraian.index')
                ->with('success', 'Sub uraian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubUraian  $subUraian
     * @return \Illuminate\Http\Response
     */
    public function show(SubUraian $subUraian)
    {
        return view('sub-uraian.show', compact('subUraian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubUraian  $subUraian
     * @return \Illuminate\Http\Response
     */
    public function edit(SubUraian $subUraian)
    {
        $uraian = Uraian::with('kategori')
                    ->latest()
                    ->get();

        return view('sub-uraian.edit', compact('subUraian', 'uraian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubUraian  $subUraian
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubUraian  $subUraian
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubUraian $subUraian)
    {
        $subUraian->delete();

        return redirect()
                ->route('master-data.sub-uraian.index')
                ->with('success', 'Sub uraian berhasil dihapus');
    }
}