<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'tanggal',
        'ruangan_id',
        'keterangan',
        'nama_petugas_k3rs',
        'nama_petugas_ruangan',
        'ttd_k3rs',
        'ttd_ruangan',
        'jawaban',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTING (INI SUDAH BENAR, TAPI DIPERTEGAS)
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'jawaban' => 'array',
        'tanggal' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI RUANGAN
    |--------------------------------------------------------------------------
    */

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER (BIAR VIEW TIDAK RIBET)
    |--------------------------------------------------------------------------
    */

    public function getJawabanAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }
}