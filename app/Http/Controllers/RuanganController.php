<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data = Ruangan::latest()->paginate(10);

        return view('ruangan.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('ruangan.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => ['required', 'string', 'max:255'],
            'lokasi'       => ['required', 'string', 'max:255'],
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi',
            'lokasi.required'       => 'Lokasi ruangan wajib diisi',
        ]);

        Ruangan::create($validated);

        return redirect()
            ->route('master-data.ruangan.index')
            ->with('success', 'Data ruangan berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show(Ruangan $ruangan)
    {
        return view('ruangan.show', compact('ruangan'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Ruangan $ruangan)
    {
        $validated = $request->validate([
            'nama_ruangan' => ['required', 'string', 'max:255'],
            'lokasi'       => ['required', 'string', 'max:255'],
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi',
            'lokasi.required'       => 'Lokasi ruangan wajib diisi',
        ]);

        $ruangan->update($validated);

        return redirect()
            ->route('master-data.ruangan.index')
            ->with('success', 'Data ruangan berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()
            ->route('master-data.ruangan.index')
            ->with('success', 'Data ruangan berhasil dihapus');
    }
}