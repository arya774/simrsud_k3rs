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
       $data = Ruangan::latest()->get();

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
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'lokasi'       => 'required|string|max:255',
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi',
            'lokasi.required'       => 'Lokasi ruangan wajib diisi',
        ]);

        try {

            Ruangan::create([
                'nama_ruangan' => $request->nama_ruangan,
                'lokasi'       => $request->lokasi,
            ]);

            return redirect()
                ->route('master-data.ruangan.index')
                ->with('success', 'Data ruangan berhasil ditambahkan');

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
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
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'lokasi'       => 'required|string|max:255',
        ], [
            'nama_ruangan.required' => 'Nama ruangan wajib diisi',
            'lokasi.required'       => 'Lokasi ruangan wajib diisi',
        ]);

        try {

            $ruangan->update([
                'nama_ruangan' => $request->nama_ruangan,
                'lokasi'       => $request->lokasi,
            ]);

            return redirect()
                ->route('master-data.ruangan.index')
                ->with('success', 'Data ruangan berhasil diperbarui');

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy(Ruangan $ruangan)
    {
        try {

            $ruangan->delete();

            return redirect()
                ->route('master-data.ruangan.index')
                ->with('success', 'Data ruangan berhasil dihapus');

        } catch (\Throwable $e) {

            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}